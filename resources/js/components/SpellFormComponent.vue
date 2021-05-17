<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="card spell-card column is-half is-offset-one-quarter">
                <header class="card-header">
                    <h1 class="card-header-title is-centered" v-text="currentSpell==undefined ?'New spell': edit? form.name : 'View for: ' + form.name"/>
                </header>
                <div class="card-content">
                    <div class="content">
                        <query-message :success="form.isSuccess()" :fail="form.isFail()"
                                       :message="form.failMessage || form.successMessage"></query-message>
                        <form @submit.prevent="submit">
                                <label class="label" for="name">Name</label>
                                <div class="control">
                                    <input id="name"
                                           v-model="form.name"
                                           class="input"
                                           :readonly="!edit"
                                           v-bind:class="{ 'is-danger': form.errors.has('name')}"
                                           type="text" autofocus>

                                </div>
                                <p class="help is-danger" v-if="form.errors.has('name')"
                                   v-text="form.errors.get('name')"/>

                                <label class="label" for="quote">Quote</label>
                                <div class="control">
                                    <input id="quote"
                                           v-model="form.quote"
                                           class="input"
                                           :readonly="!edit"
                                           v-bind:class="{ 'is-danger': form.errors.has('quote')}"
                                           type="text" autofocus>
<!--                                </div>-->
                                <p class="help is-danger" v-if="form.errors.has('quote')"
                                   v-text="form.errors.get('quote')"/>
                            </div>
                            <div class="field">
                                <label class="label" for="kind">Kind</label>
                                <div class="control">
                                    <div class="select is-fullwidth" :class="loading ? 'is-loading' : ''">
                                        <select id="kind" :disabled="loading || !edit" v-model="form.kind_id" >
                                            <option v-if="loading" :value="this.form.kind_id"> Loading...</option>
                                            <option v-for="ki in kinds" v-if="!loading" v-text="ki.name"
                                                    :value="ki.id"/>
                                        </select>
                                    </div>
                                </div>
                                <p class="help is-danger" v-if="form.errors.has('kind_id')"
                                   v-text="form.errors.get('kind_id')"/>
                                <p v-if="noKinds" class="help is-warning">Select a kind to create spells!</p>
                            </div>

                            <div class="field">
                                <label class="label" for="description">Description</label>
                                <div class="control">
                                    <textarea id="description" v-model="form.description" class="textarea" :readonly="!edit"></textarea>
                                </div>
                                <p class="help is-danger" v-if="form.errors.has('description')"
                                   v-text="form.errors.get('description')"/>
                                <p class="help">
                                    You can use <a target="_blank"
                                                   href="https://daringfireball.net/projects/markdown/syntax">
                                    Markdown</a> syntax here.
                                </p>
                            </div>
                            <button type="submit" class="button is-large is-primary is-outlined is-fullwidth"
                                    v-text="'Save'" :disabled="loading" v-show="edit"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let form = new Form({
        'spell_id': '',
        'name': '',
        'quote': '',
        'description': '',
        'kind_id': '',
        'noReset': ['kind_id']
    });

    export default {
        name: "SpellFormComponent",
        components: {
            QueryMessage
        },
        props: {
            isEditable: {
                required: false,
                type: Boolean,
                default: false
            },
            currentSpell: {
                required: false,
                type: Object
            }
        },
        data() {
            return {
                edit: undefined,
                form: form,
                url: '',
                kinds: [],
                noKinds: false
            }
        },
        methods: {
            submit() {
                if (this.currentSpell != undefined)
                    this.form
                        .put(this.url);
                else
                    this.form
                        .post(this.url)
                        .then((response) => {
                            this.url = '/spell/' + response.slug;

                            this.form.spell_id = response.spell_id;
                            this.form.name = response.name;
                            this.form.quote = response.quote;
                            this.form.description = response.description;
                            this.form.kind_id = response.kind_id;

                            this.form.noReset = ['spell_id', 'name', 'quote', 'description', 'kind_id'];

                            this.edit = true;

                            window.history.pushState("", "", this.url);
                        });
            }
        },
        created() {
            axios.get('/list/kind')
                .then(response => {
                    this.kinds = response.data;

                    if (this.loading)
                        this.noKinds = true;
                });

            this.edit = this.isEditable;

            if (this.currentSpell != undefined) {
                this.url = '/spell/' + this.currentSpell.slug;
                this.form.spell_id = this.currentSpell.id;
                this.form.name = this.currentSpell.name;
                this.form.quote = this.currentSpell.quote;
                this.form.description = this.currentSpell.description;
                this.form.kind_id = this.currentSpell.kind_id;

                this.form.noReset = ['spell_id', 'name', 'quote', 'description', 'kind_id'];
            } else {
                this.url = '/spell';
            }
        },

        computed: {
            loading() {
                return !this.kinds.length
            }
        },

        watch: {
            kinds() {
                if (!this.loading && this.form.kind_id === '') {
                    this.form.kind_id = _.first(this.kinds).id;
                }
            }
        }
    }
</script>

<style scoped>

</style>
