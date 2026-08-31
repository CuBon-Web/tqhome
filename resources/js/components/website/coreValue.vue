<template>
  <div>
    <h3 class="page-title">Quản lý "Giá trị cốt lõi"</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div
              class="row"
              v-for="(item, key) in objData"
              :key="'core-value-' + key"
              style="margin-bottom: 8px"
            >
              <div class="col-md-12 mb-2 d-flex align-items-center justify-content-between">
                <strong>Mục #{{ key + 1 }}</strong>
                <label
                  v-if="key !== 0"
                  style="cursor: pointer; margin: 0"
                  title="Xóa mục"
                  @click="removeItem(key)"
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
                    :title="'gia-tri-cot-loi-' + (key + 1)"
                  ></image-upload>
                </div>
              </div>

              <div class="col-md-9">
                <div class="form-group">
                  <label>Tiêu đề <span class="text-danger">*</span></label>
                  <vs-input
                    type="text"
                    v-model="item.title"
                    size="default"
                    placeholder="VD: An toàn"
                    class="w-100"
                  />
                </div>
                <div class="form-group">
                  <label>Mô tả</label>
                  <vs-input
                    type="text"
                    v-model="item.description"
                    size="default"
                    placeholder="Mô tả ngắn về giá trị..."
                    class="w-100"
                  />
                </div>
                <div class="form-group">
                  <label>Trạng thái</label>
                  <vs-select v-model="item.status">
                    <vs-select-item value="1" text="Hiện" />
                    <vs-select-item value="0" text="Ẩn" />
                  </vs-select>
                </div>
              </div>

              <hr style="border: 0.5px solid #04040426; width: 100%; margin: 16px 0" />
            </div>

            <vs-button color="primary" @click="saveItems">Lưu</vs-button>
            <vs-button color="success" @click="addItem">Thêm mục</vs-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

const defaultItem = () => ({
  title: "",
  description: "",
  image: "",
  status: "1",
});

export default {
  name: "coreValue",
  data() {
    return {
      objData: [defaultItem()],
    };
  },
  methods: {
    ...mapActions(["saveCoreValue", "listCoreValue", "loadings"]),

    saveItems() {
      const invalid = this.objData.findIndex((it) => !it.title.trim());
      if (invalid !== -1) {
        this.$error(`Mục #${invalid + 1}: Tiêu đề không được để trống.`);
        return;
      }
      this.loadings(true);
      this.saveCoreValue({ data: this.objData })
        .then(() => {
          this.loadings(false);
          this.$success("Lưu thành công");
          this.loadItems();
        })
        .catch(() => {
          this.loadings(false);
          this.$error("Lưu thất bại");
        });
    },

    addItem() {
      this.objData.push(defaultItem());
    },

    removeItem(i) {
      this.objData.splice(i, 1);
    },

    loadItems() {
      this.loadings(true);
      this.listCoreValue()
        .then((response) => {
          this.loadings(false);
          const rows = response.data || [];
          this.objData = rows.length
            ? rows.map((r) => ({
                ...defaultItem(),
                ...r,
                status: String(r.status ?? 1),
              }))
            : [defaultItem()];
        })
        .catch(() => {
          this.loadings(false);
        });
    },
  },
  mounted() {
    this.loadItems();
  },
};
</script>
