<script>
import axios from 'axios'
import modalProduk from './modalProduk'
import DataTable from '../../../components/DataTable.vue'
export default {
    components: {
        modalProduk,
        DataTable,
    },
    data() {
        return {
            dataSelected: {},
            showModal: false,
            search: '',
            headers: [
                { text: 'No Urut', value: 'no_urut' },
                { text: 'Nama Produk', value: 'nama' },
                { text: 'Jumlah Transfer', value: 'jumlah' },
                { text: 'Tanggal Penerimaan', value: 'tgl_tf' },
                { text: 'Aksi', value: 'aksi', sortable: false },
            ]
        }
    },
    props: ['dataTable'],
    methods: {
        async detail(data) {
            try {
                const { data: mapArray } = await axios.get(`/api/gbj/rw/riwayat_permintaan/${data.id}`)

                this.dataSelected = {
                    header: data,
                    data: mapArray
                }

                this.showModal = true
                this.$nextTick(() => {
                    $('.modalProduk').modal('show')
                })
            } catch (error) {
                console.log(error)
            }
        },
        cetak(id) {
            window.open(`/gbj/surat_pengiriman/${id}`, '_blank')
        }
    },
}
</script>
<template>
    <div v-if="!$store.state.loading">
        <modalProduk v-if="showModal" @closeModal="showModal = false" :dataSelected="dataSelected" />
        <div class="d-flex flex-row-reverse bd-highlight">
            <div class="p-2 bd-highlight">
                <input type="text" v-model="search" class="form-control" placeholder="Cari...">
            </div>
        </div>
        <DataTable :headers="headers" :items="dataTable" :search="search">
            <template #item.aksi="{ item }">
                <button class="btn btn-sm btn-outline-info" @click="detail(item)">
                    <i class="fas fa-info-circle"></i>
                    Detail
                </button>
                <button class="btn btn-sm btn-outline-primary" @click="cetak(item.id)">
                    <i class="fas fa-print"></i>
                    Cetak
                </button>
            </template>
        </DataTable>
    </div>
</template>