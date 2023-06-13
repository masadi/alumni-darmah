<template>
  <div class="auth-wrapper auth-v1 px-2">
    <div class="auth-inner py-2">

      <!-- Register v1 -->
      <b-card class="mb-0">
        <div class="text-center">
          <b-card-title class="mb-1 font-weight-bold" title-tag="h1">
            <b-img :src="logoUrl" style="height:28px" /> 
          </b-card-title>
          <b-card-text class="my-1">
            {{appName}}
          </b-card-text>
        </div>

        <!-- form -->
        <validation-observer ref="registerForm">
          <b-form class="auth-register-form mt-2" @submit.prevent="validationForm">
            <b-form-group label="Nama Lengkap" label-for="nama" :state="state.nama" :invalid-feedback="feedback.nama">
              <b-form-input id="nama" v-model="form.nama" :state="state.nama"  placeholder="Nama Lengkap tanpa Gelar" />
            </b-form-group>
            <b-form-group label="Tempat Lahir" label-for="tempat_lahir" :state="state.tempat_lahir" :invalid-feedback="feedback.tempat_lahir">
              <b-form-input id="tempat_lahir" v-model="form.tempat_lahir" :state="state.tempat_lahir" placeholder="Tempat Lahir" />
            </b-form-group>
            <b-form-group label="Tanggal Lahir" label-for="tanggal_lahir" :invalid-feedback="feedback.tanggal_lahir" :state="state.tanggal_lahir">
                <b-form-datepicker v-model="form.tanggal_lahir" show-decade-nav button-variant="outline-secondary" left locale="id" aria-controls="tanggal" @context="onContext" placeholder="== Pilih Tanggal Lahir ==" />
              </b-form-group>
            <b-form-group label="NIK" label-for="nik" :state="state.nik" :invalid-feedback="feedback.nik">
              <b-form-input id="nik" v-model="form.nik" :state="state.nik" placeholder="NIK" />
            </b-form-group>
            <b-form-group label="Nomor HP" label-for="hp" :state="state.hp" :invalid-feedback="feedback.hp">
              <b-form-input id="hp" v-model="form.hp" :state="state.hp" placeholder="Nomor HP Aktif" />
            </b-form-group>
            <b-form-group label="Alamat" label-for="alamat" :state="state.alamat" :invalid-feedback="feedback.alamat">
              <b-form-input id="alamat" v-model="form.alamat" :state="state.alamat" placeholder="Alamat" />
            </b-form-group>
            <b-form-group label="Provinsi" label-for="provinsi_id" :invalid-feedback="feedback.provinsi_id" :state="state.provinsi_id">
              <v-select id="provinsi_id" v-model="form.provinsi_id" :reduce="name => name.code" label="name" :options="data_provinsi" placeholder="== Pilih Provinsi ==" @input="getKabupaten" :searchable="true" :state="state.provinsi_id">
                <template #no-options="{ search, searching, loading }">
                    Tidak ada data
                </template>
              </v-select>
            </b-form-group>
            <b-form-group label="Kabupaten/Kota" label-for="kabupaten_id" :invalid-feedback="feedback.kabupaten_id" :state="state.kabupaten_id">
              <b-overlay :show="loading_kabupaten" opacity="0.6" size="md" spinner-variant="secondary">
                <v-select id="kabupaten_id" v-model="form.kabupaten_id" :reduce="name => name.code" label="name" :options="data_kabupaten" placeholder="== Pilih Kabupaten/Kota ==" @input="getKecamatan" :searchable="true" :state="state.kabupaten_id">
                  <template #no-options="{ search, searching, loading }">
                    Tidak ada data
                  </template>
                </v-select>
              </b-overlay>
            </b-form-group>
            <b-form-group label="Kecamatan" label-for="kecamatan_id" :invalid-feedback="feedback.kecamatan_id" :state="state.kecamatan_id">
              <b-overlay :show="loading_kecamatan" opacity="0.6" size="md" spinner-variant="secondary">
                <v-select id="kecamatan_id" v-model="form.kecamatan_id" :reduce="name => name.code" label="name" :options="data_kecamatan" placeholder="== Pilih Kecamatan ==" @input="getDesa" :searchable="true" :state="state.kecamatan_id">
                  <template #no-options="{ search, searching, loading }">
                    Tidak ada data
                  </template>
                </v-select>
              </b-overlay>
            </b-form-group>
            <b-form-group label="Desa/Kelurahan" label-for="desa_id" :invalid-feedback="feedback.desa_id" :state="state.desa_id">
              <b-overlay :show="loading_desa" opacity="0.6" size="md" spinner-variant="secondary">
                <v-select id="desa_id" v-model="form.desa_id" :reduce="name => name.code" label="name" :options="data_desa" placeholder="== Pilih Desa/Kelurahan ==" :searchable="true" :state="state.desa_id">
                  <template #no-options="{ search, searching, loading }">
                    Tidak ada data
                  </template>
                </v-select>
              </b-overlay>
            </b-form-group>
            <b-form-group label="Tahun Masuk" label-for="tahun_masuk" :state="state.tahun_masuk" :invalid-feedback="feedback.tahun_masuk">
              <b-form-input id="tahun_masuk" v-model="form.tahun_masuk" :state="state.tahun_masuk" placeholder="Tahun Masuk" />
            </b-form-group>
            <b-form-group label="Tahun Keluar" label-for="tahun_keluar">
              <b-form-input id="tahun_keluar" v-model="form.tahun_keluar" placeholder="Kosongkan jika masih aktif" />
            </b-form-group>
            <b-button variant="primary" block type="submit">
              KIRIM
            </b-button>
          </b-form>
        </validation-observer>
      </b-card>
    <!-- /Register v1 -->
    </div>
  </div>

</template>

<script>
import { ValidationProvider, ValidationObserver } from 'vee-validate'
import vSelect from 'vue-select'
import {
  BCard,
  BLink,
  BCardTitle,
  BCardText,
  BForm,
  BButton,
  BFormInput,
  BFormGroup,
  BInputGroup,
  BImg,
  BOverlay,
  BFormDatepicker,
} from 'bootstrap-vue'
import VuexyLogo from '@core/layouts/components/Logo.vue'
import { required, email } from '@validations'
import { togglePasswordVisibility } from '@core/mixins/ui/forms'
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue'

export default {
  components: {
    VuexyLogo,
    // BSV
    BCard,
    BLink,
    BCardTitle,
    BCardText,
    BForm,
    BButton,
    BFormInput,
    BFormGroup,
    BInputGroup,
    BImg,
    BOverlay,
    BFormDatepicker,
    vSelect,
    // validations
    ValidationProvider,
    ValidationObserver,
  },
  mixins: [togglePasswordVisibility],
  data() {
    return {
      loading_kabupaten: false,
      loading_kecamatan: false,
      loading_desa: false,
      form: {
        nama: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        nik: '',
        hp: '',
        alamat: '',
        provinsi_id: '',
        kabupaten_id: '',
        kecamatan_id: '',
        desa_id: '',
        tahun_masuk: '',
        tahun_keluar: '',
      },
      state: {
        nama: null,
        tempat_lahir: null,
        tanggal_lahir: null,
        nik: null,
        hp: null,
        alamat: null,
        provinsi_id: null,
        kabupaten_id: null,
        kecamatan_id: null,
        desa_id: null,
        tahun_masuk: null,
        tahun_keluar: null,
      },
      feedback: {
        nama: '',
        tempat_lahir: '',
        tanggal_lahir: '',
        nik: '',
        hp: '',
        alamat: '',
        provinsi_id: '',
        kabupaten_id: '',
        kecamatan_id: '',
        desa_id: '',
        tahun_masuk: '',
        tahun_keluar: '',
      },
      data_provinsi: [],
      data_kabupaten: [],
      data_kecamatan: [],
      data_desa: [],
      logoImg: require('@/assets/images/logo/logo.png'),
    }
  },
  computed: {
    passwordToggleIcon() {
      return this.passwordFieldType === 'password' ? 'EyeIcon' : 'EyeOffIcon'
    },
    appName(){
      return app_name;
    },
    logoUrl(){
      return this.logoImg
    }
  },
  created() {
    this.loadPostsData()
  },
  methods: {
    loadPostsData() {
      this.$http.get('/provinsi').then(response => {
        let getData = response.data
        this.data_provinsi = getData.data
      });
    },
    validationForm() {
      this.$refs.registerForm.validate().then(success => {
        if (success) {
          this.$http.post('/register', this.form).then(response => {
            let getData = response.data
            if(getData.errors){
              this.state.nama = (getData.errors.nama) ? false : null
              this.state.tempat_lahir = (getData.errors.tempat_lahir) ? false : null
              this.state.tanggal_lahir = (getData.errors.tanggal_lahir) ? false : null
              this.state.nik = (getData.errors.nik) ? false : null
              this.state.hp = (getData.errors.hp) ? false : null
              this.state.alamat = (getData.errors.alamat) ? false : null
              this.state.provinsi_id = (getData.errors.provinsi_id) ? false : null
              this.state.kabupaten_id = (getData.errors.kabupaten_id) ? false : null
              this.state.kecamatan_id = (getData.errors.kecamatan_id) ? false : null
              this.state.desa_id = (getData.errors.desa_id) ? false : null
              this.state.tahun_masuk = (getData.errors.tahun_masuk) ? false : null
              this.state.tahun_keluar = (getData.errors.tahun_keluar) ? false : null
              this.feedback.nama = (getData.errors.nama) ? getData.errors.nama.join(', ') : ''
              this.feedback.tempat_lahir = (getData.errors.tempat_lahir) ? getData.errors.tempat_lahir.join(', ') : ''
              this.feedback.tanggal_lahir = (getData.errors.tanggal_lahir) ? getData.errors.tanggal_lahir.join(', ') : ''
              this.feedback.nik = (getData.errors.nik) ? getData.errors.nik.join(', ') : ''
              this.feedback.hp = (getData.errors.hp) ? getData.errors.hp.join(', ') : ''
              this.feedback.alamat = (getData.errors.nama) ? getData.errors.alamat.join(', ') : ''
              this.feedback.provinsi_id = (getData.errors.provinsi_id) ? getData.errors.provinsi_id.join(', ') : ''
              this.feedback.kabupaten_id = (getData.errors.kabupaten_id) ? getData.errors.kabupaten_id.join(', ') : ''
              this.feedback.kecamatan_id = (getData.errors.kecamatan_id) ? getData.errors.kecamatan_id.join(', ') : ''
              this.feedback.desa_id = (getData.errors.desa_id) ? getData.errors.desa_id.join(', ') : ''
              this.feedback.tahun_masuk = (getData.errors.tahun_masuk) ? getData.errors.tahun_masuk.join(', ') : ''
            } else if(getData.error){
              this.message = getData.message
            } else {
              this.$toast({
                component: ToastificationContent,
                position: 'bottom-center',
                props: {
                  title: `Registrasi Berhasil`,
                  icon: 'CoffeeIcon',
                  variant: 'success',
                  text: `Anda telah berhasil register. Terima Kasih atas kerjasamanya!`,
                },
              })
              this.form.nama = ''
              this.form.tempat_lahir = ''
              this.form.tanggal_lahir = ''
              this.form.nik = ''
              this.form.hp = ''
              this.form.alamat = ''
              this.form.provinsi_id = ''
              this.form.kabupaten_id = ''
              this.form.kecamatan_id = ''
              this.form.desa_id = ''
              this.form.tahun_masuk = ''
              this.form.tahun_keluar = ''
            }
          }).catch(error => {
            this.$refs.registerForm.setErrors(error.response.data.error)
          })
        }
      })
    },
    getKabupaten(val){
      this.form.kabupaten_id = ''
      this.data_kabupaten = []
      if(val){
        this.loading_kabupaten = true
        this.$http.post('/kabupaten', this.form).then(response => {
          this.loading_kabupaten = false
          let getData = response.data
          this.data_kabupaten = getData.data
        });
      }
    },
    getKecamatan(val){
      this.form.kecamatan_id = ''
      this.data_kecamatan = []
      if(val){
        this.loading_kecamatan = true
        this.$http.post('/kecamatan', this.form).then(response => {
          this.loading_kecamatan = false
          let getData = response.data
          this.data_kecamatan = getData.data
        });
      }
    },
    getDesa(val){
      this.form.desa_id = ''
      this.data_desa = []
      if(val){
        this.loading_desa = true
        this.$http.post('/desa', this.form).then(response => {
          this.loading_desa = false
          let getData = response.data
          this.data_desa = getData.data
        });
      }
    },
    onContext(ctx) {
      this.formatted = ctx.selectedFormatted
    },
  },
}
</script>

<style lang="scss">
@import '~@resources/scss/vue/pages/page-auth.scss';
</style>
