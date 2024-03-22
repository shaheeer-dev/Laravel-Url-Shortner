<template>
  <div class="border my-5 rounded-md">
    <div class="p-6 flex">
      <div class="flex-1">
        <div class="flex justify-between items-center">
          <div>
            <span class="text-gray-800">Title: {{ url.title }}</span>
          </div>
          <button v-if="!isexistingUrlCard"  @click="deleteUrl(url.id)" class="text-red-500 underline">Delete</button>
        </div>
        <p class="mt-4 text-sm">
          <span class="text-gray-600">Original Url:</span>
          <a :href="url.original_url" target="_blank" class="text-blue-600 hover:underline">{{ url.original_url }}</a>
        </p>
        <p class="mt-4 text-sm text-gray-600">Shortened Url:
          <a :href="url.original_url" target="_blank" class="text-blue-600 hover:underline">{{ url.shortener_url }}</a>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    url: {
      type: Object,
      required: true
    },
    isexistingUrlCard: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    deleteUrl(urlId) {
      this.$emit('delete', urlId);
    },
  }
};
</script>
