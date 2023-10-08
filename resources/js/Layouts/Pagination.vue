<template>
  <div v-if="links.length > 3">
    <div class="flex flex-wrap -mb-1">
      <template v-for="(link, key) in links">
        <div v-if="link.url === null" :key="key" class="mb-1 text-white mr-1 px-4 py-3  text-sm leading-4 border rounded" v-html="link.label" />
        <Link v-else :key="`link-${key}`" class="mb-1 mr-1 px-4 py-3 text-white hover:text-gray-900 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded" :class="{ 'active-pagination-link': link.active }" :href="link.url" v-html="link.label" />
      </template>
    </div>
  </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    name:'Pagination',
  components: {
    Link,
  },
  props: {
    links: Array,
  },
}
</script>
