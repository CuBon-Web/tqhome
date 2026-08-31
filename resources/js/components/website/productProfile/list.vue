<template>
  <div class="pp-admin">
    <PageHeader
      title="Hồ sơ nguồn gốc sản phẩm"
      description="Quản lý danh mục hồ sơ hiển thị trên trang website. Mỗi danh mục chứa nhiều hồ sơ và ảnh minh chứng."
    >
      <template slot="actions">
        <vs-button type="gradient" color="primary" @click="$router.push({ name: 'productProfileAdd' })">
          <i class="material-icons" style="font-size:18px;vertical-align:middle;margin-right:4px;">add</i>
          Thêm danh mục
        </vs-button>
      </template>
    </PageHeader>

    <div class="pp-stats">
      <div class="pp-stat">
        <div class="pp-stat__icon pp-stat__icon--green">
          <i class="material-icons">folder</i>
        </div>
        <div>
          <div class="pp-stat__value">{{ list.length }}</div>
          <div class="pp-stat__label">Danh mục</div>
        </div>
      </div>
      <div class="pp-stat">
        <div class="pp-stat__icon pp-stat__icon--blue">
          <i class="material-icons">description</i>
        </div>
        <div>
          <div class="pp-stat__value">{{ totalDocuments }}</div>
          <div class="pp-stat__label">Tổng hồ sơ</div>
        </div>
      </div>
      <div class="pp-stat">
        <div class="pp-stat__icon pp-stat__icon--amber">
          <i class="material-icons">visibility</i>
        </div>
        <div>
          <div class="pp-stat__value">{{ activeCount }}</div>
          <div class="pp-stat__label">Đang hiển thị</div>
        </div>
      </div>
    </div>

    <div class="pp-toolbar">
      <div class="pp-toolbar__field">
        <label class="pp-filter-label">Tìm danh mục</label>
        <el-input v-model="keyword" placeholder="Nhập tiêu đề..." clearable prefix-icon="el-icon-search" />
      </div>
      <div class="pp-toolbar__field" style="max-width:180px;">
        <label class="pp-filter-label">Trạng thái</label>
        <el-select v-model="statusFilter" placeholder="Tất cả" clearable style="width:100%">
          <el-option value="" label="Tất cả" />
          <el-option value="1" label="Đang hiện" />
          <el-option value="0" label="Đang ẩn" />
        </el-select>
      </div>
      <div>
        <vs-button color="dark" type="border" @click="resetFilter">Xóa lọc</vs-button>
      </div>
    </div>

    <div v-if="filteredList.length" class="pp-grid">
      <article v-for="item in filteredList" :key="item.id" class="pp-card">
        <div class="pp-card__media">
          <img v-if="item.image" :src="item.image" :alt="item.title">
          <div v-else class="pp-card__placeholder">
            <i class="material-icons">inventory_2</i>
          </div>
          <span class="pp-card__sort">#{{ item.sort }}</span>
          <span class="pp-card__status">
            <vs-chip :color="item.status == 1 ? 'success' : 'danger'" transparent>
              {{ item.status == 1 ? 'Hiện' : 'Ẩn' }}
            </vs-chip>
          </span>
        </div>
        <div class="pp-card__body">
          <h3 class="pp-card__title">{{ item.title }}</h3>
          <p class="pp-card__desc">{{ item.description || 'Chưa có mô tả' }}</p>
          <div class="pp-card__meta">
            <span class="pp-badge">
              <i class="material-icons" style="font-size:14px;">description</i>
              {{ item.documents_count || 0 }} hồ sơ
            </span>
          </div>
        </div>
        <div class="pp-card__actions">
          <router-link :to="{ name: 'productProfileDocuments', params: { id: item.id } }">
            <i class="material-icons" style="font-size:16px;">folder_open</i>
            Quản lý hồ sơ
          </router-link>
          <router-link :to="{ name: 'productProfileEdit', params: { id: item.id } }">
            <i class="material-icons" style="font-size:16px;">edit</i>
            Sửa
          </router-link>
          <button type="button" class="pp-action--danger" @click="confirmDestroy(item.id)">
            <i class="material-icons" style="font-size:16px;">delete</i>
            Xóa
          </button>
        </div>
      </article>
    </div>

    <div v-else class="pp-empty">
      <div class="pp-empty__icon">
        <i class="material-icons">create_new_folder</i>
      </div>
      <h3 class="pp-empty__title">{{ list.length ? 'Không tìm thấy danh mục' : 'Chưa có danh mục hồ sơ' }}</h3>
      <p class="pp-empty__desc">
        {{ list.length ? 'Thử đổi bộ lọc hoặc từ khóa tìm kiếm.' : 'Bắt đầu bằng cách thêm danh mục đầu tiên như Thịt lợn, Thịt gà...' }}
      </p>
      <vs-button v-if="!list.length" type="gradient" color="primary" @click="$router.push({ name: 'productProfileAdd' })">
        Thêm danh mục đầu tiên
      </vs-button>
      <vs-button v-else color="dark" type="border" @click="resetFilter">Xóa bộ lọc</vs-button>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import PageHeader from './PageHeader.vue';

export default {
  name: 'productProfileList',
  components: { PageHeader },
  data: () => ({
    list: [],
    keyword: '',
    statusFilter: '',
    id_item: '',
  }),
  computed: {
    totalDocuments() {
      return this.list.reduce((sum, item) => sum + (item.documents_count || 0), 0);
    },
    activeCount() {
      return this.list.filter(item => item.status == 1).length;
    },
    filteredList() {
      let rows = this.list.slice();
      const kw = (this.keyword || '').trim().toLowerCase();
      if (kw) {
        rows = rows.filter(item => {
          const title = (item.title || '').toLowerCase();
          const desc = (item.description || '').toLowerCase();
          return title.indexOf(kw) !== -1 || desc.indexOf(kw) !== -1;
        });
      }
      if (this.statusFilter !== '' && this.statusFilter != null) {
        rows = rows.filter(item => String(item.status) === String(this.statusFilter));
      }
      return rows;
    },
  },
  methods: {
    ...mapActions(['listProductProfileCategories', 'deleteProductProfileCategory', 'loadings']),
    loadList() {
      this.loadings(true);
      this.listProductProfileCategories().then(response => {
        this.loadings(false);
        this.list = response.data || [];
      }).catch(() => { this.loadings(false); });
    },
    resetFilter() {
      this.keyword = '';
      this.statusFilter = '';
    },
    confirmDestroy(id) {
      this.id_item = id;
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: 'Xóa danh mục?',
        text: 'Toàn bộ hồ sơ và ảnh trong danh mục này sẽ bị xóa vĩnh viễn.',
        accept: this.destroy,
      });
    },
    destroy() {
      this.loadings(true);
      this.deleteProductProfileCategory({ id: this.id_item }).then(() => {
        this.loadings(false);
        this.$success('Đã xóa danh mục');
        this.loadList();
      }).catch(() => {
        this.loadings(false);
        this.$error('Xóa thất bại');
      });
    },
  },
  mounted() {
    this.loadList();
  },
};
</script>

<style lang="scss" scoped>
@import './admin.scss';
</style>
