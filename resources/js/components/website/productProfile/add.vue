<template>
  <div class="pp-admin">
    <PageHeader
      title="Thêm danh mục hồ sơ"
      description="Tạo danh mục mới như Thịt lợn, Thịt gà... Sau khi lưu bạn sẽ được chuyển sang trang quản lý hồ sơ."
      :breadcrumbs="breadcrumbs"
    />

    <CategoryForm v-model="objData" upload-title="profile-cat-add" />

    <div class="pp-savebar">
      <span class="pp-savebar__hint">Tiêu đề danh mục là bắt buộc</span>
      <div class="pp-header-actions">
        <vs-button color="dark" type="border" @click="$router.push({ name: 'productProfileList' })">Hủy</vs-button>
        <vs-button color="primary" type="gradient" @click="save">
          <i class="material-icons" style="font-size:18px;vertical-align:middle;margin-right:4px;">add</i>
          Tạo danh mục
        </vs-button>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import PageHeader from './PageHeader.vue';
import CategoryForm from './CategoryForm.vue';

export default {
  name: 'productProfileAdd',
  components: { PageHeader, CategoryForm },
  data() {
    return {
      objData: {
        title: '',
        description: '',
        image: '',
        sort: 0,
        status: '1',
      },
    };
  },
  computed: {
    breadcrumbs() {
      return [
        { label: 'Hồ sơ nguồn gốc', to: { name: 'productProfileList' } },
        { label: 'Thêm mới' },
      ];
    },
  },
  methods: {
    ...mapActions(['saveProductProfileCategory', 'loadings']),
    save() {
      if (!this.objData.title.trim()) {
        this.$error('Tiêu đề không được để trống');
        return;
      }
      this.loadings(true);
      this.saveProductProfileCategory(this.objData).then(response => {
        this.loadings(false);
        this.$success('Đã tạo danh mục — bắt đầu thêm hồ sơ');
        const id = response.data && response.data.id;
        if (id) {
          this.$router.push({ name: 'productProfileDocuments', params: { id } });
        } else {
          this.$router.push({ name: 'productProfileList' });
        }
      }).catch(() => {
        this.loadings(false);
        this.$error('Tạo danh mục thất bại');
      });
    },
  },
};
</script>

<style lang="scss" scoped>
@import './admin.scss';
</style>
