<template>
  <div class="video-uploader" :style="'min-height:' + height">
    <el-upload
      class="video-uploader__box"
      v-loading="loading"
      action="/upload"
      name="video"
      :http-request="request"
      :before-upload="beforeUpload"
      :show-file-list="false"
      accept="video/mp4,video/webm,video/quicktime,.mp4,.webm,.mov,.m4v"
    >
      <video
        v-if="previewUrl"
        :src="previewUrl"
        class="video-uploader__preview"
        muted
        playsinline
        controls
        @click.stop
      ></video>
      <div v-else class="video-uploader__placeholder" :style="{ minHeight: height }">
        <i class="el-icon-video-camera-solid"></i>
        <span>Chọn video từ máy</span>
        <small>MP4, WebM, MOV — tối đa 80MB</small>
      </div>
    </el-upload>
    <div v-if="progress > 0 && progress < 100" class="video-uploader__progress">
      Đang tải lên {{ progress }}%
    </div>
    <div v-if="previewUrl" class="video-uploader__actions">
      <a href="javascript:void(0)" @click.prevent="handleRemove">Xóa video</a>
    </div>
  </div>
</template>

<script>
export default {
  name: "upload-video",
  props: {
    value: {
      type: String,
      default: "",
    },
    height: {
      type: String,
      default: "180px",
    },
  },
  data() {
    return {
      loading: false,
      progress: 0,
    };
  },
  computed: {
    previewUrl() {
      return this.value || "";
    },
  },
  methods: {
    isAllowedVideo(file) {
      const allowedTypes = [
        "video/mp4",
        "video/webm",
        "video/quicktime",
        "video/x-m4v",
      ];
      if (file.type && allowedTypes.includes(file.type)) {
        return true;
      }
      const ext = (file.name || "").split(".").pop().toLowerCase();
      return ["mp4", "webm", "mov", "m4v"].includes(ext);
    },
    beforeUpload(file) {
      if (!this.isAllowedVideo(file)) {
        this.$message.error("Chỉ chấp nhận video MP4, WebM hoặc MOV.");
        return false;
      }
      const maxBytes = 80 * 1024 * 1024;
      if (file.size > maxBytes) {
        this.$message.error("Video không được vượt quá 80MB.");
        return false;
      }
      return true;
    },
    handleRemove() {
      this.progress = 0;
      this.$emit("input", "");
    },
    request(req) {
      this.loading = true;
      this.progress = 0;
      const xhr = new XMLHttpRequest();
      xhr.withCredentials = false;
      xhr.open("POST", __ENV__.link + "api/upload-video");
      xhr.upload.onprogress = (e) => {
        if (e.lengthComputable) {
          this.progress = Math.round((e.loaded / e.total) * 100);
        }
      };
      xhr.onload = () => {
        this.loading = false;
        if (xhr.status !== 200) {
          let message = "Tải video thất bại";
          try {
            const err = JSON.parse(xhr.responseText);
            message = err.message || (err.errors && err.errors.video && err.errors.video[0]) || message;
          } catch (e) {
            if (xhr.status === 413) {
              message = "File quá lớn. Hãy giảm dung lượng hoặc tăng giới hạn PHP.";
            }
          }
          this.$message.error(message);
          this.progress = 0;
          return;
        }
        const json = JSON.parse(xhr.responseText);
        this.progress = 100;
        this.$emit("input", (json.path || "").replace(__ENV__.link, "/"));
      };
      xhr.onerror = () => {
        this.loading = false;
        this.progress = 0;
        this.$message.error("Không thể tải video lên máy chủ.");
      };
      const formData = new FormData();
      formData.append("video", req.file, req.file.name);
      xhr.send(formData);
    },
  },
};
</script>

<style>
.video-uploader__box .el-upload {
  border: 1px dashed #d9d9d9;
  border-radius: 6px;
  cursor: pointer;
  overflow: hidden;
  width: 100%;
  display: block;
}
.video-uploader__box .el-upload:hover {
  border-color: #409eff;
}
.video-uploader__placeholder {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 6px;
  color: #8c939d;
  padding: 16px;
  width: 100%;
}
.video-uploader__placeholder i {
  font-size: 32px;
}
.video-uploader__placeholder span {
  font-size: 13px;
  font-weight: 600;
}
.video-uploader__placeholder small {
  font-size: 11px;
}
.video-uploader__preview {
  display: block;
  width: 100%;
  max-height: 220px;
  background: #111;
  object-fit: contain;
}
.video-uploader__progress {
  margin-top: 8px;
  font-size: 12px;
  color: #409eff;
}
.video-uploader__actions {
  margin-top: 6px;
  font-size: 12px;
}
</style>
