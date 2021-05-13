<template>
    <div class="container">
        <div class="columns is-multiline">
            <div class="card spell-card column is-half is-offset-one-quarter">
                <header class="card-header">
                    <h1 class="card-header-title is-centered" v-text="edit ? form.title : 'New spell'"/>
                </header>
                <div class="card-content">
                    <div class="content">
                        <query-message :success="form.isSuccess()" :fail="form.isFail()"
                                       :message="form.failMessage || form.successMessage"></query-message>
                        <form @submit.prevent="submit">
                            <div class="field" v-if="!edit">
                                <label class="label" for="title">Title</label>
                                <div class="control">
                                    <input id="title"
                                           v-model="form.title"
                                           class="input"
                                           v-bind:class="{ 'is-danger': form.errors.has('title')}"
                                           type="text" autofocus>
                                </div>
                                <p class="help is-danger" v-if="form.errors.has('title')"
                                   v-text="form.errors.get('title')"/>
                            </div>

                            <div class="field">
                                <label class="label" for="kind">Kind</label>
                                <div class="control">
                                    <div class="select is-fullwidth" :class="loading ? 'is-loading' : ''">
                                        <select id="kind" :disabled="loading" v-model="form.kind_id">
                                            <option v-if="loading" :value="this.form.kind_id"> Loading...</option>
                                            <option v-for="cat in categories" v-if="!loading" v-text="cat.name"
                                                    :value="cat.id"/>
                                        </select>
                                    </div>
                                </div>
                                <p class="help is-danger" v-if="form.errors.has('kind_id')"
                                   v-text="form.errors.get('kind_id')"/>
                                <p v-if="noCategories" class="help is-warning">Add some categories to create spells!</p>
                            </div>

                            <div class="field">
                                <label class="label" for="body">Body</label>
                                <div class="control">
                                    <textarea id="body" v-model="form.body" class="textarea"></textarea>
                                </div>
                                <p class="help is-danger" v-if="form.errors.has('body')"
                                   v-text="form.errors.get('body')"/>
                                <p class="help">
                                    You can use <a target="_blank"
                                                   href="https://daringfireball.net/projects/markdown/syntax">
                                    Markdown</a> syntax here.
                                </p>
                            </div>

                            <button type="submit" class="button is-large is-primary is-outlined is-fullwidth"
                                    v-text="edit ? 'Save' : 'Post'" :disabled="loading"/>
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
        'title': '',
        'body': '',
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
                categories: [],
                noCategories: false
            }
        },
        methods: {
            submit() {
                if (this.edit)
                    this.form
                        .put(this.url);
                else
                    this.form
                        .post(this.url)
                        .then((response) => {
                            this.url = '/spell/' + response.slug;

                            this.form.spell_id = response.spell_id;
                            this.form.title = response.title;
                            this.form.body = response.body;
                            this.form.kind_id = response.kind_id;

                            this.form.noReset = ['spell_id', 'title', 'body', 'kind_id'];

                            this.edit = true;

                            window.history.pushState("", "", this.url);
                        });
            }
        },
        created() {
            axios.get('/list/categories')
                .then(response => {
                    this.categories = response.data;

                    if (this.loading)
                        this.noCategories = true;
                });

            this.edit = this.isEditable;

            if (this.edit) {
                this.url = '/spell/' + this.currentSpell.slug;
                this.form.spell_id = this.currentSpell.id;
                this.form.title = this.currentSpell.title;
                this.form.body = this.currentSpell.body;
                this.form.kind_id = this.currentSpell.kind_id;

                this.form.noReset = ['spell_id', 'title', 'body', 'kind_id'];
            } else {
                this.url = '/spell';
            }
        },

        computed: {
            loading() {
                return !this.categories.length
            }
        },

        watch: {
            categories() {
                if (!this.loading && this.form.kind_id === '') {
                    this.form.kind_id = _.first(this.categories).id;
                }
            }
        }
    }
</script>

<style scoped>

</style>
