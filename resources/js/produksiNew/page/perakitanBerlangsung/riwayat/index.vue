<script>
import DataTable from '../../../components/DataTable.vue';
import modalPilihan from './modalPilihan.vue';
export default {
    props: ['dataRiwayat'],
    components: {
        DataTable,
        modalPilihan
    },
    data() {
        return {
            headers: [
                {
                    text: 'id',
                    value: 'id',
                    sortable: false,
                },
                {
                    text: 'No. Seri',
                    value: 'noseri'
                },
                {
                    text: 'Tanggal Dibuat',
                    value: 'tgl_buat'
                },
                {
                    text: 'No BPPB',
                    value: 'no_bppb'
                },
                {
                    text: 'Nama Produk',
                    value: 'nama'
                },
                {
                    text: 'Aksi',
                    sortable: false,
                    value: 'aksi'
                }
            ],
            search: '',
            checkAll: false,
            noSeriSelected: [],
            cetakSeriSingle: [],
            cetakSeriType: 'all',
        }
    },
    methods: {
        checkAllSeri() {
            this.checkAll = !this.checkAll;
            if (this.checkAll) {
                this.noSeriSelected = this.dataRiwayat.map((item) => item);
            } else {
                this.noSeriSelected = [];
            }
        },
        selectNoSeri(noseri) {
            if (this.noSeriSelected.find((data) => data === noseri)) {
                this.noSeriSelected = this.noSeriSelected.filter((data) => data !== noseri)
                this.checkAll = false
            } else {
                this.noSeriSelected.push(noseri)
            }

            if (this.noSeriSelected.length === this.dataRiwayat.length) {
                this.checkAll = true
            }
        },
        cetakSeri(noseri) {
            this.cetakSeriSingle.push(noseri)
            this.cetakSeriType = 'single'
            this.$nextTick(() => {
                $('.modalPilihan').modal('show');
            });
        },
        cetakBanyakSeri() {
            this.cetakSeriType = 'all'
            this.$nextTick(() => {
                $('.modalPilihan').modal('show');
            });
        }
    },
}
</script>
<template>
    <div>
        <modalPilihan :data="cetakSeriType == 'single' ? cetakSeriSingle : noSeriSelected" v-if="cetakSeriSingle.length > 0 || noSeriSelected.length > 0" />
        <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
                <button class="btn btn-outline-primary btn-sm" v-if="noSeriSelected.length > 0" @click="cetakBanyakSeri">
                    <i class="fa fa-print"></i>
                    Cetak Nomor Seri
                </button>
            </div>
            <div class="p-2 bd-highlight">
                <input type="text" v-model="search" class="form-control" placeholder="Cari...">
            </div>
        </div>
        <DataTable :headers="headers" :items="dataRiwayat" :search="search">
            <template #header.id>
                <input type="checkbox" @click="checkAllSeri" :checked="checkAll">
            </template>

            <template #item.id="{ item }">
                <input type="checkbox" :checked="noSeriSelected && noSeriSelected.find((noseri) => noseri === item)"
                    @click="selectNoSeri(item)" />
            </template>
            <template #item.aksi="{ item }">
                <button class="btn btn-outline-primary btn-sm" @click="cetakSeri(item)">
                    <i class="fa fa-print"></i>
                    Cetak Nomor Seri
                </button>
            </template>
        </DataTable>
    </div>
</template>