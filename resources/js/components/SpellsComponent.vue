<template>
    <div class="container">
        <hero main-title="Spells"></hero>
        <div class="columns is-multiline">
            <div class="column is-three-fifths is-offset-one-fifth">
                <success-box :message="successMessage" v-if="showSuccessMessage"></success-box>
                <div class="box custom-box" v-if="hasSpells">
                    <spell-list :spell-list="spells" :user="user" v-on:open-modal="setModal"></spell-list>
                </div>
                <error-box message="No spells found" v-if="!hasSpells"></error-box>
            </div>
        </div>
        <delete-modal :title="modalTitle" :delete-url="modalUrl" :active="modalActive" :content="modalContent"
                      :entry-id="modalId" v-on:close-modal="toggleModal"></delete-modal>
    </div>
</template>

<script>
    import SpellList from './SpellListComponent';

    export default {
        components: {
            SpellList,
            ErrorBox,
            SuccessBox,
            DeleteModal
        },
        name: "SpellsComponent",
        data() {
            return {
                spells: [],
                user: {},
                modalActive: false,
                modalTitle: '',
                modalContent: '',
                modalUrl: '',
                modalId: 0,
                successMessage: ''
            }
        },
        props: {
            allSpells: {
                type: Array,
                required: true
            },
            currentUser: {
                type: Object,
                required: true
            }
        },
        methods: {
            toggleModal(info) {
                this.modalActive = !this.modalActive;

                if(info.id !== 0) {
                    this.spells = _.remove(this.spells, blg => blg.id !== info.id);
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
            this.spells = this.allSpells;
            this.user = this.currentUser;
        },
        computed: {
            hasSpells() {
                return !!this.spells.length;
            },
            showSuccessMessage() {
                return this.successMessage !== '';
            }
        }

    }
</script>

<style scoped>

</style>
