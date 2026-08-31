<template>
  <div class="row">
    <div class="col-lg-8">
      <div class="pp-form-card">
        <div class="pp-form-section">
          <h3 class="pp-form-section__title">Thông tin danh mục</h3>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label>Ảnh đại diện</label>
                <image-upload type="avatar" v-model="local.image" :title="uploadTitle" @input="emitChange" />
                <small class="text-muted">Hiển thị trên trang Hồ sơ website</small>
              </div>
            </div>
            <div class="col-md-8">
              <div class="form-group">
                <label>Tiêu đề <span class="text-danger">*</span></label>
                <vs-input class="w-100" v-model="local.title" placeholder="VD: Thịt lợn, Thịt gà..." @input="emitChange" />
              </div>
              <div class="form-group">
                <label>Mô tả ngắn</label>
                <vs-textarea v-model="local.description" rows="4" placeholder="Mô tả nguồn gốc, tiêu chuẩn chất lượng..." @input="emitChange" />
              </div>
            </div>
          </div>
        </div>

        <div class="pp-form-section mb-0">
          <h3 class="pp-form-section__title">Hiển thị</h3>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group mb-md-0">
                <label>Thứ tự sắp xếp</label>
                <vs-input type="number" class="w-100" v-model="local.sort" @input="emitChange" />
                <small class="text-muted">Số nhỏ hiển thị trước</small>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group mb-0">
                <label>Trạng thái</label>
                <vs-select v-model="local.status" @input="emitChange">
                  <vs-select-item value="1" text="Hiện trên website" />
                  <vs-select-item value="0" text="Ẩn" />
                </vs-select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="pp-preview">
        <p class="text-muted mb-2" style="font-size:12px;font-weight:600;">XEM TRƯỚC</p>
        <div class="pp-preview__avatar">
          <img v-if="local.image" :src="local.image" alt="">
          <i v-else class="material-icons" style="font-size:32px;color:#1b4d2e;">folder</i>
        </div>
        <p class="pp-preview__title">{{ local.title || 'Tiêu đề danh mục' }}</p>
        <p class="pp-preview__desc">{{ local.description || 'Mô tả sẽ hiển thị tại đây trên trang Hồ sơ.' }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ProductProfileCategoryForm',
  props: {
    value: { type: Object, required: true },
    uploadTitle: { type: String, default: 'profile-cat' },
  },
  data() {
    return {
      local: this.cloneValue(this.value),
    };
  },
  watch: {
    value: {
      deep: true,
      handler(v) {
        this.local = this.cloneValue(v);
      },
    },
  },
  methods: {
    cloneValue(v) {
      return {
        title: v.title || '',
        description: v.description || '',
        image: v.image || '',
        sort: v.sort != null ? v.sort : 0,
        status: v.status != null ? String(v.status) : '1',
        id: v.id,
      };
    },
    emitChange() {
      this.$emit('input', { ...this.value, ...this.local });
    },
  },
};
</script>

<style lang="scss" scoped>
@import './admin.scss';
</style>
