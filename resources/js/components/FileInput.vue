<template>
    <div class="col-md-6">
        <div class="custom-file">
            <input id="attachments" name="attachments" ref="attachments" type="file" accept="image/*" @change="updateFiles" class="custom-file-input" multiple>
            <label id="attachmentsLabel" ref="attachmentsLabel" for="attachments" class="custom-file-label">Wybierz plik</label>
        </div>

        <ul>
            <li v-for="file in files" :key="file.name">
                {{ file.name }}
            </li>
        </ul>

        <span ref="errorInfo" class="text-danger" v-show="error"></span>

        <br/>

        <span class="text-info">
            Możesz załączyć 
            {{ this.remainingSize == this.maxSize ? 'w sumie' : 'jeszcze' }} 
            {{ this.remainingSize == this.maxSize ? '10' : (this.remainingSize / 1048576).toFixed(2) }}MB. 
            ({{ this.remainingNumber == this.maxNumber ? 'w sumie' : 'jeszcze' }} 
            )
        </span>
    </div>
</template>

<script>
// https://www.webtrickshome.com/faq/how-to-display-uploaded-image-in-html-using-javascript
// http://jsbin.com/uboqu3/1/edit?html,js,output
export default {
    data() {
        return {
            files: [],
            size: 0,
            maxSize: 10485760,
            remainingSize: 10485760,
            maxNumber: 10,
            remainingNumber: 10,
            error: false,
        }
    },
    methods: {
        reset() {
            this.$refs.attachments.value = '';

            if(!/safari/i.test(navigator.userAgent)) {
                this.$refs.attachments.type = '';
                this.$refs.attachments.type = 'file';
            }

            this.remainingSize = this.maxSize;
        },
        checkExtensions() {
            for (let i = 0; i < this.files.length; i++) {
                if (!(/image/g.test(this.files[i].type)) && this.files[i].type != 'image/tiff') {
                    this.reset();

                    this.error = true;
                    this.$refs.errorInfo.innerHTML = 'Załącznikami mogą być tylko zdjęcia. Zdjęcie nie może posiadać rozszerzenia TIFF.';
                }
            }
        },
        calculateRemainingSize() {
            let result = this.maxSize;

            for (let i = 0; i < this.files.length; i++) {
                result -= this.files[i].size;
            }

            this.remainingSize = result;
        },
        checkTotalSize() {
            if (this.remainingSize < 0) {
                this.reset();

                this.error = true;
                this.$refs.errorInfo.innerHTML = 'Nie możesz załączyć więcej niż 10MB.';
            }
        },
        updateFiles() {
            this.files = this.$refs.attachments.files;
            
            this.checkExtensions();
            this.calculateRemainingSize();
            this.checkTotalSize();
            
            console.log(this.files);
        },
    },
    mounted() {
        attachments.onchange = function() {
            if (this.value.split(/(\\|\/)/g).pop() == '') {
                attachmentsLabel.innerHTML = 'Wybierz plik';
            }
            else {
                const numberOfFiles = this.$refs.attachments.files.length;

                this.$refs.attachmentsLabel.innerHTML = `Ilość plików: ${numberOfFiles}`;
            }
        };
    }
}
</script>

<style>
.custom-file-label::after
{
    content: 'Otwórz' !important;
}
</style>
