<template>
    <div class="container">
        <hero main-title="Kinds"></hero>
        <div class="columns is-multiline">
            <div class="column is-three-fifths is-offset-one-fifth">
                <success-box :message="successMessage" v-if="showSuccessMessage"></success-box>
                <div class="box custom-box" v-if="hasKinds">
                    <kind-list :kinds="kinds" v-on:open-modal="setModal"></kind-list>
                </div>
                <error-box message="No kinds found" v-if="!hasKinds"></error-box>
            </div>
        </div>
        <delete-modal :title="modalTitle" :delete-url="modalUrl" :active="modalActive" :content="modalContent"
                      :entry-id="modalId" v-on:close-modal="toggleModal"></delete-modal>
    </div>
</template>

<script>
    import KindList from '../../../../BIC4_GRP-A3-MagicAlmanac/resources/js/components/KindListComponent';

    export default {
        components:{
            KindList,
            ErrorBox,
            SuccessBox,
            DeleteModal
        },
        name: "kindsComponent",
        data() {
            return {
                kinds: [],
                modalActive: false,
                modalTitle: '',
                modalContent: '',
                modalUrl: '',
                modalId: 0,
                successMessage: ''
            }
        },
        props: {
            allKinds: {
                type: Array,
                required: true
            }
        },
        methods: {
            toggleModal(info) {
                this.modalActive = !this.modalActive;

                if(info.id !== 0) {
                    this.kinds = _.remove(this.kinds, cat => cat.id !== info.id);
                    this.successMessage = info.message;
                }
            },
            setModal(data) {
                this.modalId = data.id;
                this.modalTitle = data.title;
                this.modalContent = data.content;
                this.modalUrl = data.url;
                this.toggleModal({id: 0});
            }
        },
        created() {
            this.kinds = this.allKinds;
        },
        computed: {
            hasKinds() {
                return !!this.kinds.length;
            },
            showSuccessMessage() {
                return this.successMessage !== '';
            }
        }

    }
</script>

<style scoped>

</style>
