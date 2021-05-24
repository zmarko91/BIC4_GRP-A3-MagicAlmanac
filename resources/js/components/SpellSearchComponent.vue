<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="card spell-card column is-half is-offset-one-quarter">
                <header class="card-header">
                    <h1 class="card-header-title is-centered" v-text="'Search for spell'"/>
                </header>
                <form @submit.prevent="search">
                    <label class="label" for="searchField">Contains</label>
                    <div class="control">
                        <input id="searchField"
                               v-model="form.q"
                               class="input"
                               type="text" autofocus>
                    </div>
                    <br>
                    <button type="submit" class="button is-large is-primary is-outlined is-fullwidth"
                            v-text="'Scroll in scrolls'"/>
                    <div class="box custom-box" v-if="hasSpells">
                        <spell-list :spell-list="currentSpells" :user="user" v-on:open-modal="setModal"></spell-list>
                    </div>
                </form>
            </div>
        </div>
    <delete-modal :title="modalTitle" :delete-url="modalUrl" :active="modalActive" :content="modalContent"
                  :entry-id="modalId" v-on:close-modal="toggleModal"></delete-modal>
    </div>
</template>

<script>
    import SpellList from './SpellListComponent';
    let form = new Form({
        'q': ''
    });

    let currentSpells = new Object();

    export default {
        components: {
            SpellList,
            ErrorBox,
            SuccessBox,
            DeleteModal
        },
        name: "SpellSearchComponent",
        props : {
            currentUser: {
                type: Object,
                required: true
            },
            spellProp: {
                type: Array,
                required: false
            }
        },
        data() {
            return {
                currentSpells : [],
                form : form,
                user : {},
                modalActive: false,
                modalTitle: '',
                modalContent: '',
                modalUrl: '',
                modalId: 0,
                successMessage: ''
            }
        },
        methods: {
            search() {
                this.form
                    .post('/search/spell')
                    .then((response) => {
                        this.currentSpells = response;
                    });
            },
            created() {
                this.user = this.currentUser;
                this.currentSpells = this.spellProp;
            },
            toggleModal(info) {
                this.modalActive = !this.modalActive;

                if(info.id !== 0) {
                    this.currentSpells = _.remove(this.currentSpells, blg => blg.id !== info.id);
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
        computed: {
            hasSpells() {
                return !!this.currentSpells.length;
            },
            showSuccessMessage() {
                return this.successMessage !== '';
            }
        }
    }
</script>

<style scoped>

</style>
