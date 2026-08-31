<template>
  <div>
    <h3 class="page-title">Quản lý "Lịch sử hình thành"</h3>
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div
              class="row"
              v-for="(item, key) in objData"
              :key="'history-' + key"
              style="margin-bottom: 8px"
            >
              <div class="col-md-12 mb-2 d-flex align-items-center justify-content-between">
                <strong>Mốc #{{ key + 1 }}</strong>
                <label
                  v-if="key !== 0"
                  style="cursor: pointer; margin: 0"
                  title="Xóa mốc"
                  @click="removeItem(key)"
                >
                  <vs-icon icon="clear"></vs-icon>
                </label>
              </div>

              <div class="col-md-12">
                <div class="form-group">
                  <label>Năm / mốc thời gian <span class="text-danger">*</span></label>
                  <vs-input
                    type="text"
                    v-model="item.year"
                    size="default"
                    placeholder="VD: 2004 hoặc 2024 →"
                    class="w-100"
                  />
                </div>
                <div class="form-group">
                  <label>Tiêu đề <span class="text-danger">*</span></label>
                  <vs-input
                    type="text"
                    v-model="item.title"
                    size="default"
                    placeholder="VD: KHỞI ĐẦU"
                    class="w-100"
                  />
                </div>
                <div class="form-group">
                  <label>Mô tả</label>
                  <vs-input
                    type="text"
                    v-model="item.description"
                    size="default"
                    placeholder="Mô tả ngắn về mốc lịch sử..."
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
            <vs-button color="success" @click="addItem">Thêm mốc</vs-button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions } from "vuex";

const defaultItem = () => ({
  year: "",
  title: "",
  description: "",
  status: "1",
});

export default {
  name: "historyMilestone",
  data() {
    return {
      objData: [defaultItem()],
    };
  },
  methods: {
    ...mapActions(["saveHistoryMilestone", "listHistoryMilestone", "loadings"]),

    saveItems() {
      const invalidYear = this.objData.findIndex((it) => !String(it.year || "").trim());
      if (invalidYear !== -1) {
        this.$error(`Mốc #${invalidYear + 1}: Năm / mốc thời gian không được để trống.`);
        return;
      }
      const invalidTitle = this.objData.findIndex((it) => !String(it.title || "").trim());
      if (invalidTitle !== -1) {
        this.$error(`Mốc #${invalidTitle + 1}: Tiêu đề không được để trống.`);
        return;
      }
      this.loadings(true);
      this.saveHistoryMilestone({ data: this.objData })
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
      this.listHistoryMilestone()
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
