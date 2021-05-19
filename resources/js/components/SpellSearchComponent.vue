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
                        <spell-list :spell-list="currentSpells" :user="user"></spell-list>
                    </div>
                </form>
            </div>
        </div>
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
            SpellList
        },
        props : {
            currentUser: {
                type: Object,
                required: true
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
                        console.log("Du vuitrottl!!!!!");
                        console.log(response);

                        this.currentSpells = response;
                    });
            },
            created() {
                this.user = this.currentUser;
            }
        },
        computed: {
            hasSpells() {
                return !!this.currentSpells.length;
            }
        }
    }
</script>

<style scoped>

</style>
