<template>
  <div class="pp-page-header">
    <div>
      <nav v-if="breadcrumbs.length" class="pp-breadcrumb" aria-label="Breadcrumb">
        <template v-for="(item, index) in breadcrumbs">
          <router-link v-if="item.to" :key="'bc-link-' + index" :to="item.to">{{ item.label }}</router-link>
          <span v-else :key="'bc-text-' + index" class="pp-breadcrumb__current">{{ item.label }}</span>
          <span v-if="index < breadcrumbs.length - 1" :key="'bc-sep-' + index" class="pp-breadcrumb__sep">/</span>
        </template>
      </nav>
      <h4 class="pp-page-title">{{ title }}</h4>
      <p v-if="description" class="pp-page-desc">{{ description }}</p>
    </div>
    <div v-if="$slots.actions" class="pp-header-actions">
      <slot name="actions"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductProfilePageHeader',
  props: {
    title: { type: String, required: true },
    description: { type: String, default: '' },
    breadcrumbs: { type: Array, default: () => [] },
  },
};
</script>
