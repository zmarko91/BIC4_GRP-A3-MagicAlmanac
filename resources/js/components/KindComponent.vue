<template>
    <div class="container">
        <hero :main-title="kind.name" :sub-title="kind.description" />
        <div class="columns is-multiline">
            <div class="column is-three-fifths is-offset-one-fifth">
                <div class="box custom-box" v-if="hasSpells">
                    <spell-list :spell-list="this.kindSpells" :user="user" :show-kind="false" v-on:open-modal="setModal"></spell-list>
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
    name: "kindComponent",
    components: {
        ErrorBox,
        SpellList,
        DeleteModal
    },
    data() {
        return {
            modalActive: false,
            modalTitle: '',
            modalContent: '',
            modalUrl: '',
            modalId: 0,
            successMessage: '',
            kindSpells: []
        }
    },
    methods: {
        toggleModal(info) {
            this.modalActive = !this.modalActive;

            if(info.id !== 0) {
                this.kindSpells = _.remove(this.kindSpells, k => k.id !== info.id);
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
    props: {
        kind: {
            required: true
        },
        user: {
            required: true
        },
        spells: {
            required: true
        }
    },
    created() {
        this.kindSpells = this.spells;
    },
    computed: {
        hasSpells() {
            return !!this.kindSpells.length;
        },
        showSuccessMessage() {
            return this.successMessage !== '';
        }
    }
}
</script>

<style scoped>

</style>
