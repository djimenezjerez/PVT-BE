<template>
  <button class="btn btn-primary dim"
          type="button"
          data-toggle="tooltip"
          data-placement="top"
          :title="title"
          :disabled="loading"
          @click="modal()"
          v-if="quotaAid.isValidated"
          >
      <i v-if="loading" class="fa fa-spinner fa-spin fa-fw" style="font-size:16px"></i>
      <i v-else class="fa fa-print"></i>
      &nbsp;
      {{ loading ? 'Imprimiendo...' : 'Imprimir' }}
  </button>
</template>
<script>
import { mapGetters } from 'vuex';
    export default {
      props: ["title", "urlPrint", "quotaAidId", "message"],
      data(){
        return {
          loading: false,
        }
      },
      methods: {
        print() {
          return {
            printable: `${this.urlPrint}`,
            type: "pdf",
            modalMessage: "Generando documentos de impresión, por favor espere un momento.",
            showModal: true,
            onError: err => console.log(err),
            onLoadingStart: () => this.loading = true,
            onLoadingEnd: () => this.loading = false
          };
        },
        modal() {
          this.loading = true;
          if (this.message) {
            this.$swal({
              title: "Escribe una nota:",
              input: "textarea",
              inputValue: '',
              inputAttributes: {
                autocapitalize: "off"
              },
              html: `Tamaño del texto <br>
              <label class="label-control" for="small">Pequeño</label><input id="small" value="text-sm-1" type="radio" name="size">
              <label class="label-control" for="normal">Normal</label><input id="normal" value="text-base" type="radio" name="size" checked>
              <label class="label-control" for="large">Grande</label><input id="large" value="text-base-1" type="radio" name="size">
              `,
              showCancelButton: true,
              confirmButtonText: "Imprimir",
              showLoaderOnConfirm: true,
              preConfirm: note => {
                let size = null;
                var radios = document.getElementsByName('size');
                for (var i = 0, length = radios.length; i < length; i++) {
                    if (radios[i].checked) {
                        size = radios[i].value;
                      break;
                    }
                }
                return axios
                  .post(`/quota_aid/${this.quotaAidId}/save_certification_note`, {
                    note: note,
                    size: size
                  })
                  .then(response => {
                    if (!response.data) {
                      throw new Error(response.statusText);
                      this.loading = false;
                    }
                    return response;
                  })
                  .catch(error => {
                    this.$swal.showValidationError(`Request failed: ${error}`);
                    this.loading = false;
                  });
              }
              // allowOutsideClick: () => !this.swal.isLoading()
            }).then(result => {
              if (result.value) {
                printJS(this.print());
                this.loading = false;
              }else{
                this.loading = false;
              }
            });
          }else{
            printJS(this.print());
            setTimeout(() => {
              this.loading = false;
            }, 1000);
          }
        }
      },
      computed: {
        ...mapGetters('quotaAidForm',{
            quotaAid: 'getData'
        }),
      }
    };
</script>

