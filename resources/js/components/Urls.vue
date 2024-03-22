<template>
    <div>
        <form @submit.prevent="submit">
            <input
                type="text"
                name="title"
                required
                maxlength="255"
                placeholder="Title"
                v-model="fields.title"
                class="block w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            />
            <input
                type="text"
                name="original_url"
                required
                maxlength="255"
                placeholder="Original Url"
                v-model="fields.original_url"
                class="block w-full border-gray-300 mt-5 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
            />
            <button
                type="submit"
                class="mt-4 bg-blue-500 text-white font-bold py-2 px-4 rounded-md shadow-sm hover:bg-transparent border hover:text-blue-500 hover:border-blue-500"
            >
                Save
            </button>

            <p v-if="error" class="text-red-500">Error: {{ error }}</p>
        </form>
        <div v-if="existingUrl" class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="flex items-center mb-5 px-2">
                <button
                    @click="resetExistingUrl()"
                    class="text-blue-500 underline"
                >
                    All Urls
                </button>
                <p class="text-gray-500 text-center ml-20">
                    This URL is already Shortened
                </p>
            </div>
            <UrlCard
                :url="existingUrl"
                @delete="deleteUrl"
                :isexistingUrlCard="true"
            />
        </div>

        <div
            v-if="!existingUrl && allUrls"
            class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8"
        >
            <h1 class="text-3xl font-semibold text-center">All URLs</h1>
            <div v-if="allUrls.length === 0">
                <h3 class="text-sm text-gray-500 text-center mt-10">
                    No record found!
                </h3>
            </div>
            <div class="mt-6 bg-white shadow-sm rounded-lg">
                <UrlCard
                    v-for="url in allUrls"
                    :key="url.id"
                    :url="url"
                    @delete="deleteUrl"
                />
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import UrlCard from "./UrlCard.vue";

export default {
    components: {
        UrlCard,
    },
    props: { urls: { type: Array, required: true }, shortenerUrlRoute: String },

    data() {
        return { fields: {}, error: "", allUrls: this.urls, existingUrl: "" };
    },

    methods: {
        submit() {
            this.existingUrl = this.findExistingUrl();

            if (this.existingUrl) {
                return (this.fields = {});
            }
            axios
                .post("/urls", this.fields)
                .then((response) => {
                    this.allUrls.push(response.data);
                    this.fields = {};
                })
                .catch((error) => {
                    this.fields = {};
                    this.error = error.response.data.error;
                });
        },

        findExistingUrl() {
            return this.allUrls.find(
                (url) => url.original_url === this.fields.original_url
            );
        },

        deleteUrl(urlId) {
            axios
                .delete(`/urls/${urlId}`)
                .then(() => {
                    this.allUrls = this.allUrls.filter(
                        (url) => url.id !== urlId
                    );
                })
                .catch((error) => console.error("Error deleting URL:", error));
        },
        resetExistingUrl() {
            this.existingUrl = "";
        },
    },
};
</script>
