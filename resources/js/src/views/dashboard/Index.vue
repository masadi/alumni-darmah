<template>
  <b-card>
    <datatable :loading="loading_modal" :isBusy="isBusy" :items="items" :fields="fields" :meta="meta" @per_page="handlePerPage" @pagination="handlePagination" @search="handleSearch" @sort="handleSort" @action="handleAction" />
    <b-modal ref="view-modal" size="lg" :title="title" :ok-title="ok_title" ok-only>
      <b-table-simple bordered responsive v-if="detilData">
        <b-tr>
          <b-td>Nama</b-td>
          <b-td>{{detilData.nama}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Tempat, Tanggal Lahir</b-td>
          <b-td>{{`${detilData.tempat_lahir}, ${detilData.tanggal_lahir_str}`}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>NIK</b-td>
          <b-td>{{detilData.nik}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>No. Handphone</b-td>
          <b-td>{{detilData.hp}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Alamat</b-td>
          <b-td>{{detilData.alamat}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Desa/Kelurahan</b-td>
          <b-td>{{(detilData.desa) ? detilData.desa.name : ''}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Kecamatan</b-td>
          <b-td>{{(detilData.kecamatan) ? detilData.kecamatan.name : ''}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Kabupaten/Kota</b-td>
          <b-td>{{(detilData.kabupaten) ? detilData.kabupaten.name : ''}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Provinsi</b-td>
          <b-td>{{(detilData.provinsi) ? detilData.provinsi.name : ''}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Tahun Masuk</b-td>
          <b-td>{{detilData.tahun_masuk}}</b-td>
        </b-tr>
        <b-tr>
          <b-td>Tahun Keluar</b-td>
          <b-td>{{detilData.tahun_keluar}}</b-td>
        </b-tr>
      </b-table-simple>
    </b-modal>
    
  </b-card>
</template>

<script>
import { BCard, BButton, BRow, BCol, BForm, BFormGroup, BFormInput, BOverlay, BAlert, BTableSimple, BTr, BTd } from 'bootstrap-vue'
import Datatable from './Datatable.vue' //IMPORT COMPONENT DATATABLENYA

export default {
  components: {
    BCard,
    BButton,
    BRow, 
    BCol, 
    BForm, BFormGroup, BFormInput, BOverlay, BAlert, BTableSimple, BTr, BTd,
    Datatable
  },
  data() {
    return {
      detilData: null,
      title: '',
      ok_title: 'Tutup',
      loading_modal: false,
      isBusy: true,
      fields: [
        {
          key: 'nama',
          label: 'Nama Lengkap',
          sortable: true,
          thClass: 'text-center',
        },
        {
          key: 'nik',
          label: 'NIK',
          sortable: true,
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          key: 'ttl',
          label: 'Tempat, Tanggal Lahir',
          sortable: true,
          thClass: 'text-center',
        },
        {
          key: 'tahun_masuk',
          label: 'Tahun Masuk',
          sortable: true,
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          key: 'tahun_keluar',
          label: 'Tahun Keluar',
          sortable: true,
          thClass: 'text-center',
          tdClass: 'text-center',
        },
        {
          key: 'actions',
          label: 'Action',
          sortable: false,
          thClass: 'text-center',
          tdClass: 'text-center'
        },
      ],
      items: [],
      meta: {},
      current_page: 1, //DEFAULT PAGE YANG AKTIF ADA PAGE 1
      per_page: 25, //DEFAULT LOAD PERPAGE ADALAH 10
      search: '',
      sortBy: 'nama', //DEFAULT SORTNYA ADALAH CREATED_AT
      sortByDesc: false, //ASCEDING
    }
  },
  created() {
    this.loadPostsData()
  },
  methods: {
    loadPostsData() {
      this.isBusy = true
      //let current_page = this.search == '' ? this.current_page : this.current_page != 1 ? 1 : this.current_page
      let current_page = this.current_page//this.search == '' ? this.current_page : 1
      //LAKUKAN REQUEST KE API UNTUK MENGAMBIL DATA POSTINGAN
      this.$http.get('/alumni', {
        params: {
          user_id: this.user.id,
          page: current_page,
          per_page: this.per_page,
          q: this.search,
          sortby: this.sortBy,
          sortbydesc: this.sortByDesc ? 'DESC' : 'ASC'
        }
      }).then(response => {
        let getData = response.data.data
        this.isBusy = false
        this.items = getData.data
        this.meta = {
          total: getData.total,
          current_page: getData.current_page,
          per_page: getData.per_page,
          from: getData.from,
          to: getData.to,
        }
      })
    },
    //JIKA ADA EMIT TERKAIT LOAD PERPAGE, MAKA FUNGSI INI AKAN DIJALANKAN
    handlePerPage(val) {
      this.per_page = val //SET PER_PAGE DENGAN VALUE YANG DIKIRIM DARI EMIT
      this.loadPostsData() //DAN REQUEST DATA BARU KE SERVER
    },
    //JIKA ADA EMIT PAGINATION YANG DIKIRIM, MAKA FUNGSI INI AKAN DIEKSEKUSI
    handlePagination(val) {
      this.current_page = val //SET CURRENT PAGE YANG AKTIF
      this.loadPostsData()
    },
    //JIKA ADA DATA PENCARIAN
    handleSearch(val) {
      this.search = val //SET VALUE PENCARIAN KE VARIABLE SEARCH
      this.loadPostsData() //REQUEST DATA BARU
    },
    //JIKA ADA EMIT SORT
    handleSort(val) {
      if (val.sortBy) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.loadPostsData() //DAN LOAD DATA BARU BERDASARKAN SORT
      }
    },
    resetModal(){
      this.form.id = ''
      this.form.title = ''
      this.form.content = ''
    },
    handleDelete(){
      this.$swal({
        title: 'Apakah Anda yakin?',
        text: 'Tindakan ini tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yakin!',
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-outline-danger ml-1',
        },
        buttonsStyling: false,
        allowOutsideClick: false,
      }).then(result => {
        if (result.value) {
          this.$http.post('/dashboard/destroy', this.form).then(response => {
            let getData = response.data
            this.$swal({
              icon: getData.icon,
              title: getData.title,
              text: getData.text,
              customClass: {
                confirmButton: 'btn btn-success',
              },
            }).then(result => {
              this.resetModal()
              this.loadPostsData()
            })
          });
        }
      })
    },
    handleAction(data){
      this.detilData = data.item
      if(data.aksi == 'detil'){
        this.title = `Detil Biodata ${data.item.nama}`
        this.ok_title = 'Tutup'
        this.$refs['view-modal'].show()
      }
      if(data.aksi == 'edit'){
        this.title = 'Update Data'
        this.ok_title = 'Update'
        this.$refs['view-modal'].show()
      }
      if(data.aksi == 'delete'){
        this.handleDelete()
      }
    },
    handleOk(bvModalEvent) {
      bvModalEvent.preventDefault()
      this.handleSubmit()
    },
    handleSubmit() {
      this.loading_modal = true
      this.$http.post('/dashboard/store', this.form).then(response => {
        let getData = response.data
        this.loading_modal = false
        if(getData.errors){
          this.state.title = (getData.errors.title) ? false : null
          this.state.content = (getData.errors.content) ? false : null
          this.feedback.title = (getData.errors.title) ? getData.errors.title.join(', ') : ''
          this.feedback.content = (getData.errors.content) ? getData.errors.content.join(', ') : ''
        } else {
          this.$swal({
            icon: getData.icon,
            title: getData.title,
            text: getData.text,
            customClass: {
              confirmButton: 'btn btn-success',
            },
          }).then(result => {
            this.$refs['view-modal'].hide()
            this.loadPostsData()
          })
        }
      })
    },
  },
}
</script>
<style lang="scss">
@import '~@resources/scss/vue/libs/vue-sweetalert.scss';
</style>