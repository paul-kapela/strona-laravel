<template>
  <div>
    <vue-dropzone
      id="dropzone"
      ref="dropzone"
      :options="dropzoneOptions"
      v-on:vdropzone-success="emit('attachments_exist', true)"
      v-on:vdropzone-removed-file="emit('attachments_exist', true)"
    />

    <input id="image-upload-token" name="image-upload-token" :value="imageUploadToken" hidden>

    <input id="uploadUrl" :value="dropzoneOptions.url" hidden>
  </div>
</template>

<script>
import axios from "axios";
import { v4 as uuid_v4 } from "uuid";
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";

const token = document.querySelector('meta[name="csrf-token"]').content;

const pl = {
  "dictDefaultMessage": "Przeciągnij tutaj pliki, które&nbsp;chcesz przesłać",
  "dictFallbackMessage": "Twoja przeglądarka nie obsługuje przesyłania plików za pomocą przeciągnięcia i&nbsp;upuszczenia.",
  "dictFallbackText": "Proszę użyć zastępczego pola poniżej.",
  "dictFileTooBig": "Plik jest za duży ({{filesize}}MiB). Maksymalny rozmiar pliku: {{maxFilesize}}MiB.",
  "dictInvalidFileType": "Nie możesz przesłać plików z tym rozszerzeniem.",
  "dictResponseError": "Serwer odpowiedział kodem {{statusCode}}.",
  "dictCancelUpload": "Przerwij przesyłanie",
  "dictCancelUploadConfirmation": "Na pewno chcesz przerwać przesyłanie?",
  "dictRemoveFile": "Usuń plik",
  "dictRemoveFileConfirmation": null,
  "dictMaxFilesExceeded": "Nie możesz przesłać więcej plików.",
};

const en = {
  "dictDefaultMessage": "Drop files here to upload",
  "dictFallbackMessage": "Your browser does not support drag'n'drop file uploads.",
  "dictFallbackText": "Please use the fallback form below to upload your files.",
  "dictFileTooBig": "File is too big ({{filesize}}MiB). Max filesize: {{maxFilesize}}MiB.",
  "dictInvalidFileType": "You can't upload files of this type.",
  "dictResponseError": "Server responded with {{statusCode}} code.",
  "dictCancelUpload": "Cancel upload",
  "dictCancelUploadConfirmation": "Are you sure you want to cancel this upload?",
  "dictRemoveFile": "Remove file",
  "dictRemoveFileConfirmation": null,
  "dictMaxFilesExceeded": "You can not upload any more files."
};

export default {
  components: {
      vueDropzone: vue2Dropzone
  },
  props: [
      'uploadUrl',
      'existingAssignmentId',
      'attachments',
      'language'
  ],
  data() {
    return {
      imageUploadToken: 0,
      dropzoneOptions: {
        url: this.uploadUrl,
        paramName: "image",
        headers: {
          "X-CSRF-TOKEN": token
        },
        addRemoveLinks: true,

        maxFilesize: 10,
        maxFiles: 5,
        acceptedFiles: ".jpeg,.jpg,.png,.doc,.pdf,.docx",

        ...(this.language === 'pl' ? pl : en),

        init: function() {
          this.on("sending", function(file, xhr, formData) {
            formData.append('token', document.getElementById('image-upload-token').value);
          });
          this.on("success", function(file, response) {
            file.filename = response.filename;
          });
          this.on("removedfile", function(file) {
            axios.delete(document.getElementById('uploadUrl').value,
              {
                headers: {
                  "X-CSRF-TOKEN": token
                },
                data: {
                  token: document.getElementById('image-upload-token').value,
                  filename: file.name,
                }
              },
            )
            .then(response => {
              if (response.status == 200) {
              }
            })
            .catch(error => {
              console.log(error);
            });
          });
        },

        error: function(file, response) {
          console.log(response);
        }
      }
    };
  },
  methods: {
    emit: function (event, value) {
      this.$root.$emit(event, value);
    }
  },
  mounted() {
    this.imageUploadToken = uuid_v4();

    if (this.attachments) {
      let attachments = JSON.parse(this.attachments);

      attachments.forEach(attachment => {
        this.$refs.dropzone.manuallyAddFile({ "name": attachment.name, "size": attachment.size }, `${window.location.origin}/storage/app/${attachment.url}`);
      });
    }
  }
}
</script>

<style>

</style>
