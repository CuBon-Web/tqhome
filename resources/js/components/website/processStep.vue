<template>
  <div>
    <h3 class="page-title">Quản lý "Quy trình cung ứng"</h3>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-3">Cài đặt trang</h4>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label>Ảnh nền hero</label>
                  <image-upload
                    type="avatar"
                    v-model="pageData.hero_image"
                    title="process-hero"
                  ></image-upload>
                </div>
                <div class="form-group">
                  <label>Ảnh cam kết (bên phải)</label>
                  <image-upload
                    type="avatar"
                    v-model="pageData.commitment_image"
                    title="process-commitment"
                  ></image-upload>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label>Tiêu đề trang</label>
                  <vs-input class="w-100" v-model="pageData.page_title" placeholder="Quy trình cung ứng" />
                </div>
                <div class="form-group">
                  <label>Đoạn giới thiệu</label>
                  <vs-textarea v-model="pageData.intro_content" rows="5" />
                </div>
                <div class="form-group">
                  <label>Tiêu đề phần cam kết</label>
                  <vs-input class="w-100" v-model="pageData.commitment_title" placeholder="Cam kết của Kỳ Linh Food" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-3">Cam kết của Kỳ Linh Food</h4>

            <div
              class="row"
              v-for="(item, key) in commitments"
              :key="'commitment-' + key"
              style="border:1px solid #eee;border-radius:8px;padding:12px;margin-bottom:16px"
            >
              <div class="col-md-12 mb-2 d-flex align-items-center justify-content-between">
                <strong>Cam kết #{{ key + 1 }}</strong>
                <label
                  v-if="commitments.length > 1"
                  style="cursor:pointer;margin:0;color:#e55"
                  title="Xóa mục"
                  @click="removeCommitment(key)"
                >
                  <vs-icon icon="clear"></vs-icon>
                </label>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Icon</label>
                  <image-upload
                    type="avatar"
                    v-model="item.image"
                    :title="'process-commitment-icon-' + (key + 1)"
                  ></image-upload>
                </div>
              </div>

              <div class="col-md-9">
                <div class="form-group">
                  <label>Tiêu đề <span class="text-danger">*</span></label>
                  <vs-input class="w-100" v-model="item.title" placeholder="VD: An toàn" />
                </div>
                <div class="form-group">
                  <label>Mô tả</label>
                  <vs-textarea v-model="item.description" rows="3" placeholder="Mô tả ngắn về cam kết..." />
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Thứ tự</label>
                      <vs-input type="number" v-model="item.sort" class="w-100" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <vs-select v-model="item.status">
                        <vs-select-item value="1" text="Hiện" />
                        <vs-select-item value="0" text="Ẩn" />
                      </vs-select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <vs-button color="success" type="border" @click="addCommitment">
              <vs-icon icon="add"></vs-icon> Thêm cam kết
            </vs-button>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="mb-3">Các bước quy trình</h4>

            <div
              class="row"
              v-for="(item, key) in objData"
              :key="'process-' + key"
              style="border:1px solid #eee;border-radius:8px;padding:12px;margin-bottom:16px"
            >
              <div class="col-md-12 mb-2 d-flex align-items-center justify-content-between">
                <strong>Bước {{ key + 1 }}</strong>
                <label
                  v-if="objData.length > 1"
                  style="cursor:pointer;margin:0;color:#e55"
                  title="Xóa bước"
                  @click="removeItem(key)"
                >
                  <vs-icon icon="clear"></vs-icon>
                </label>
              </div>

              <div class="col-md-3">
                <div class="form-group">
                  <label>Icon bước</label>
                  <image-upload
                    type="avatar"
                    v-model="item.icon"
                    :title="'process-icon-' + (key + 1)"
                  ></image-upload>
                </div>
                <div class="form-group">
                  <label>Ảnh minh họa</label>
                  <image-upload
                    type="avatar"
                    v-model="item.image"
                    :title="'process-photo-' + (key + 1)"
                  ></image-upload>
                </div>
              </div>

              <div class="col-md-9">
                <div class="form-group">
                  <label>Tiêu đề <span class="text-danger">*</span></label>
                  <vs-input
                    class="w-100"
                    v-model="item.title"
                    :placeholder="'VD: Lựa chọn nhà cung cấp'"
                  />
                </div>
                <div class="form-group">
                  <label>Danh sách điểm (checklist)</label>
                  <div
                    v-for="(point, pKey) in item.checklist"
                    :key="'point-' + key + '-' + pKey"
                    class="d-flex align-items-center mb-2"
                  >
                    <vs-input class="w-100" v-model="item.checklist[pKey]" placeholder="Nội dung điểm..." />
                    <label
                      v-if="item.checklist.length > 1"
                      style="cursor:pointer;margin:0 0 0 8px;color:#e55"
                      @click="removeChecklistItem(key, pKey)"
                    >
                      <vs-icon icon="clear"></vs-icon>
                    </label>
                  </div>
                  <vs-button color="success" type="border" size="small" @click="addChecklistItem(key)">
                    Thêm điểm
                  </vs-button>
                </div>
                <div class="form-group">
                  <label>Link "Xem chi tiết"</label>
                  <vs-input class="w-100" v-model="item.link" placeholder="https://... hoặc /duong-dan" />
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Thứ tự</label>
                      <vs-input type="number" v-model="item.sort" class="w-100" />
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label>Trạng thái</label>
                      <vs-select v-model="item.status">
                        <vs-select-item value="1" text="Hiện" />
                        <vs-select-item value="0" text="Ẩn" />
                      </vs-select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <vs-button color="success" type="border" @click="addItem">
              <vs-icon icon="add"></vs-icon> Thêm bước
            </vs-button>
          </div>
        </div>
      </div>
    </div>

    <div class="row fixxed">
      <div class="col-12">
        <div class="saveButton">
          <vs-button color="primary" @click="save">Lưu</vs-button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  name: 'processStep',
  data() {
    return {
      pageData: this.defaultPage(),
      objData: [this.defaultItem()],
      commitments: [this.defaultCommitment()],
    };
  },
  methods: {
    ...mapActions(['saveProcessStep', 'listProcessStep', 'loadings']),
    defaultPage() {
      return {
        page_title: 'Quy trình cung ứng',
        intro_content: '',
        hero_image: '',
        commitment_title: 'Cam kết của Kỳ Linh Food',
        commitment_image: '',
      };
    },
    defaultItem() {
      return {
        title: '',
        icon: '',
        description: '',
        image: '',
        checklist: [''],
        link: '',
        sort: 0,
        status: '1',
      };
    },
    defaultCommitment() {
      return {
        title: '',
        description: '',
        image: '',
        sort: 0,
        status: '1',
      };
    },
    parseChecklist(raw) {
      if (Array.isArray(raw)) {
        return raw.length ? raw : [''];
      }
      if (typeof raw === 'string' && raw.trim() !== '') {
        try {
          const parsed = JSON.parse(raw);
          if (Array.isArray(parsed) && parsed.length) {
            return parsed;
          }
        } catch (e) {
          return [raw];
        }
      }
      return [''];
    },
    addItem() {
      this.objData.push(this.defaultItem());
    },
    removeItem(index) {
      this.objData.splice(index, 1);
    },
    addChecklistItem(stepIndex) {
      this.objData[stepIndex].checklist.push('');
    },
    removeChecklistItem(stepIndex, pointIndex) {
      this.objData[stepIndex].checklist.splice(pointIndex, 1);
    },
    addCommitment() {
      this.commitments.push(this.defaultCommitment());
    },
    removeCommitment(index) {
      this.commitments.splice(index, 1);
    },
    load() {
      this.loadings(true);
      this.listProcessStep().then(response => {
        this.loadings(false);
        if (response.page) {
          this.pageData = {
            ...this.defaultPage(),
            ...response.page,
          };
        }
        const data = response.data || [];
        if (data.length) {
          this.objData = data.map(d => ({
            title: d.title || '',
            icon: d.icon || '',
            description: d.description || '',
            image: d.image || '',
            checklist: this.parseChecklist(d.checklist),
            link: d.link || '',
            sort: d.sort != null ? String(d.sort) : '0',
            status: d.status != null ? String(d.status) : '1',
          }));
        }
        const commitmentRows = response.commitments || [];
        if (commitmentRows.length) {
          this.commitments = commitmentRows.map(d => ({
            title: d.title || '',
            description: d.description || '',
            image: d.image || '',
            sort: d.sort != null ? String(d.sort) : '0',
            status: d.status != null ? String(d.status) : '1',
          }));
        } else {
          this.commitments = [this.defaultCommitment()];
        }
      }).catch(() => { this.loadings(false); });
    },
    save() {
      const invalidStep = this.objData.some(item => !item.title.trim());
      if (invalidStep) {
        this.$error('Tiêu đề bước không được để trống');
        return;
      }
      const invalidCommitment = this.commitments.some(item => !item.title.trim());
      if (invalidCommitment) {
        this.$error('Tiêu đề cam kết không được để trống');
        return;
      }
      this.loadings(true);
      this.saveProcessStep({
        page: this.pageData,
        items: this.objData.map(item => ({
          ...item,
          checklist: (item.checklist || []).filter(point => String(point).trim() !== ''),
        })),
        commitments: this.commitments,
      }).then(() => {
        this.loadings(false);
        this.$success('Lưu thành công');
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
