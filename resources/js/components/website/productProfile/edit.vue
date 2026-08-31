<template>
  <div class="pp-admin">
    <PageHeader
      title="Sửa danh mục hồ sơ"
      description="Cập nhật thông tin hiển thị trên trang Hồ sơ website."
      :breadcrumbs="breadcrumbs"
    >
      <template slot="actions">
        <vs-button color="primary" type="border" @click="$router.push({ name: 'productProfileDocuments', params: { id: objData.id } })">
          <i class="material-icons" style="font-size:16px;vertical-align:middle;margin-right:4px;">folder_open</i>
          Quản lý hồ sơ
        </vs-button>
      </template>
    </PageHeader>

    <CategoryForm v-model="objData" :upload-title="'profile-cat-' + objData.id" />

    <div class="pp-savebar">
      <span class="pp-savebar__hint">Thay đổi sẽ hiển thị ngay trên website sau khi lưu</span>
      <div class="pp-header-actions">
        <vs-button color="dark" type="border" @click="$router.push({ name: 'productProfileList' })">Hủy</vs-button>
        <vs-button color="primary" type="gradient" @click="save">
          <i class="material-icons" style="font-size:18px;vertical-align:middle;margin-right:4px;">save</i>
          Cập nhật
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
  name: 'productProfileEdit',
  components: { PageHeader, CategoryForm },
  data() {
    return {
      objData: {
        id: this.$route.params.id,
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
        { label: this.objData.title || 'Sửa danh mục' },
      ];
    },
  },
  methods: {
    ...mapActions(['saveProductProfileCategory', 'getProductProfileCategory', 'loadings']),
    loadDetail() {
      this.loadings(true);
      this.getProductProfileCategory({ id: this.$route.params.id }).then(response => {
        this.loadings(false);
        const d = response.data;
        if (d) {
          this.objData = {
            id: d.id,
            title: d.title || '',
            description: d.description || '',
            image: d.image || '',
            sort: d.sort != null ? String(d.sort) : '0',
            status: d.status != null ? String(d.status) : '1',
          };
        }
      }).catch(() => { this.loadings(false); });
    },
    save() {
      if (!this.objData.title.trim()) {
        this.$error('Tiêu đề không được để trống');
        return;
      }
      this.loadings(true);
      this.saveProductProfileCategory(this.objData).then(() => {
        this.loadings(false);
        this.$success('Đã cập nhật danh mục');
        this.$router.push({ name: 'productProfileList' });
      }).catch(() => {
        this.loadings(false);
        this.$error('Cập nhật thất bại');
      });
    },
  },
  mounted() {
    this.loadDetail();
  },
};
</script>

<style lang="scss" scoped>
@import './admin.scss';
</style>
