<template>
  <div class="pp-admin">
    <PageHeader
      :title="'Hồ sơ: ' + (category.title || 'Đang tải...')"
      :description="category.description || 'Quản lý các hồ sơ và ảnh minh chứng trong danh mục này.'"
      :breadcrumbs="breadcrumbs"
    >
      <template slot="actions">
        <vs-button color="dark" type="border" @click="$router.push({ name: 'productProfileList' })">
          <i class="material-icons" style="font-size:16px;vertical-align:middle;margin-right:4px;">arrow_back</i>
          Danh sách
        </vs-button>
        <vs-button color="success" type="border" @click="$router.push({ name: 'productProfileEdit', params: { id: categoryId } })">
          <i class="material-icons" style="font-size:16px;vertical-align:middle;margin-right:4px;">settings</i>
          Sửa danh mục
        </vs-button>
      </template>
    </PageHeader>

    <div class="pp-layout">
      <aside class="pp-sidebar-card">
        <div class="pp-sidebar-card__hero">
          <div class="pp-sidebar-card__avatar">
            <img v-if="category.image" :src="category.image" :alt="category.title">
            <i v-else class="material-icons" style="font-size:32px;color:#1b4d2e;">folder</i>
          </div>
        </div>
        <div class="pp-sidebar-card__body">
          <h2 class="pp-sidebar-card__title">{{ category.title || '—' }}</h2>
          <p class="pp-sidebar-card__desc">{{ category.description || 'Chưa có mô tả danh mục.' }}</p>
          <div class="pp-sidebar-stats">
            <div class="pp-sidebar-stat">
              <div class="pp-sidebar-stat__value">{{ documents.length }}</div>
              <div class="pp-sidebar-stat__label">Hồ sơ</div>
            </div>
            <div class="pp-sidebar-stat">
              <div class="pp-sidebar-stat__value">{{ totalImages }}</div>
              <div class="pp-sidebar-stat__label">Ảnh</div>
            </div>
          </div>
        </div>
      </aside>

      <div>
        <div class="pp-toolbar" style="margin-bottom:16px;padding:12px 16px;">
          <div style="flex:1;font-size:13px;color:#6b7280;">
            Nhấn vào từng hồ sơ để mở rộng và chỉnh sửa. Mỗi hồ sơ có thể upload nhiều ảnh.
          </div>
          <vs-button size="small" color="dark" type="border" @click="expandAll">Mở tất cả</vs-button>
          <vs-button size="small" color="dark" type="border" @click="collapseAll">Thu gọn</vs-button>
        </div>

        <div class="pp-doc-list">
          <div
            v-for="(doc, docIndex) in documents"
            :key="'doc-' + docIndex"
            class="pp-doc-item"
            :class="{ 'is-open': doc._open }"
          >
            <div class="pp-doc-item__head" @click="toggleDoc(docIndex)">
              <span class="pp-doc-item__index">{{ docIndex + 1 }}</span>
              <div class="pp-doc-item__info">
                <p class="pp-doc-item__title">{{ doc.title || ('Hồ sơ #' + (docIndex + 1)) }}</p>
                <p class="pp-doc-item__sub">
                  {{ (doc.images || []).length }} ảnh
                  · {{ doc.status == 1 ? 'Đang hiện' : 'Đang ẩn' }}
                  · Thứ tự {{ doc.sort }}
                </p>
              </div>
              <div class="pp-doc-item__tools" @click.stop>
                <vs-chip :color="doc.status == 1 ? 'success' : 'danger'" transparent>
                  {{ doc.status == 1 ? 'Hiện' : 'Ẩn' }}
                </vs-chip>
                <button
                  v-if="documents.length > 1"
                  type="button"
                  class="btn btn-link p-0 text-danger"
                  title="Xóa hồ sơ"
                  @click="confirmRemoveDocument(docIndex)"
                >
                  <i class="material-icons" style="font-size:20px;">delete_outline</i>
                </button>
                <i class="material-icons pp-doc-item__chevron">expand_more</i>
              </div>
            </div>

            <div v-show="doc._open" class="pp-doc-item__body">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label>Tiêu đề hồ sơ</label>
                    <vs-input class="w-100" v-model="doc.title" placeholder="VD: Giấy kiểm dịch, Hóa đơn NCC..." />
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group">
                        <label>Thứ tự</label>
                        <vs-input type="number" v-model="doc.sort" class="w-100" />
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group">
                        <label>Trạng thái</label>
                        <vs-select v-model="doc.status">
                          <vs-select-item value="1" text="Hiện" />
                          <vs-select-item value="0" text="Ẩn" />
                        </vs-select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group mb-0">
                    <label>Ảnh hồ sơ <span class="text-muted">({{ (doc.images || []).length }} ảnh)</span></label>
                    <image-multi-upload
                      v-model="doc.images"
                      :title="'profile-doc-' + categoryId + '-' + (docIndex + 1)"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <button type="button" class="pp-add-doc mt-3" @click="addDocument">
          <i class="material-icons">add_circle_outline</i>
          Thêm hồ sơ mới
        </button>

        <div class="pp-savebar">
          <span class="pp-savebar__hint">
            <i class="material-icons" style="font-size:16px;vertical-align:middle;">info</i>
            Nhớ lưu sau khi thêm hoặc chỉnh sửa hồ sơ
          </span>
          <vs-button color="primary" type="gradient" @click="save">
            <i class="material-icons" style="font-size:18px;vertical-align:middle;margin-right:4px;">save</i>
            Lưu tất cả hồ sơ
          </vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';
import PageHeader from './PageHeader.vue';

export default {
  name: 'productProfileDocuments',
  components: { PageHeader },
  data() {
    return {
      categoryId: this.$route.params.id,
      category: {},
      documents: [],
      removeIndex: null,
    };
  },
  computed: {
    breadcrumbs() {
      return [
        { label: 'Hồ sơ nguồn gốc', to: { name: 'productProfileList' } },
        { label: this.category.title || 'Chi tiết' },
      ];
    },
    totalImages() {
      return this.documents.reduce((sum, doc) => sum + (doc.images ? doc.images.length : 0), 0);
    },
  },
  methods: {
    ...mapActions(['getProductProfileCategory', 'saveProductProfileDocuments', 'loadings']),
    defaultDocument(open) {
      return {
        title: '',
        images: [],
        sort: 0,
        status: '1',
        _open: open !== false,
      };
    },
    parseImages(raw) {
      if (Array.isArray(raw)) {
        return raw.filter(Boolean);
      }
      if (typeof raw === 'string' && raw.trim() !== '') {
        try {
          const parsed = JSON.parse(raw);
          if (Array.isArray(parsed)) {
            return parsed.filter(Boolean);
          }
        } catch (e) {
          return [raw];
        }
      }
      return [];
    },
    toggleDoc(index) {
      this.documents[index]._open = !this.documents[index]._open;
    },
    expandAll() {
      this.documents.forEach(doc => { doc._open = true; });
    },
    collapseAll() {
      this.documents.forEach(doc => { doc._open = false; });
    },
    addDocument() {
      this.documents.forEach(doc => { doc._open = false; });
      this.documents.push(this.defaultDocument(true));
    },
    confirmRemoveDocument(index) {
      this.removeIndex = index;
      this.$vs.dialog({
        type: 'confirm',
        color: 'danger',
        title: 'Xóa hồ sơ này?',
        text: 'Hồ sơ sẽ bị loại khỏi danh sách. Nhấn "Lưu tất cả hồ sơ" để xác nhận thay đổi.',
        accept: this.removeDocument,
      });
    },
    removeDocument() {
      if (this.removeIndex != null) {
        this.documents.splice(this.removeIndex, 1);
        this.removeIndex = null;
      }
    },
    load() {
      this.loadings(true);
      this.getProductProfileCategory({ id: this.categoryId }).then(response => {
        this.loadings(false);
        const d = response.data;
        if (!d) return;

        this.category = {
          title: d.title || '',
          description: d.description || '',
          image: d.image || '',
        };

        const rows = d.documents || [];
        if (rows.length) {
          this.documents = rows.map((doc, index) => ({
            title: doc.title || '',
            images: this.parseImages(doc.images),
            sort: doc.sort != null ? String(doc.sort) : String(index),
            status: doc.status != null ? String(doc.status) : '1',
            _open: index === 0,
          }));
        } else {
          this.documents = [this.defaultDocument(true)];
        }
      }).catch(() => { this.loadings(false); });
    },
    save() {
      this.loadings(true);
      this.saveProductProfileDocuments({
        categoryId: this.categoryId,
        documents: this.documents.map(doc => ({
          title: doc.title,
          images: (doc.images || []).filter(Boolean),
          sort: doc.sort,
          status: doc.status,
        })),
      }).then(() => {
        this.loadings(false);
        this.$success('Đã lưu hồ sơ thành công');
        this.load();
      }).catch(() => {
        this.loadings(false);
        this.$error('Lưu thất bại');
      });
    },
  },
  mounted() {
    this.load();
  },
};
</script>

<style lang="scss" scoped>
@import './admin.scss';
</style>
