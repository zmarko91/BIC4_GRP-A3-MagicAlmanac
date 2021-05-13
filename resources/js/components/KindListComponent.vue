<template>
    <div class="table-container is-fullwidth">
        <table class="table is-fullwidth is-hoverable">
            <thead>
            <tr class="title is-6">
                <table-element element-type="th">Name</table-element>
                <table-element element-type="th">Description</table-element>
                <table-element element-type="th" text-class="has-text-centered">Spell</table-element>
                <table-element element-type="th">Created</table-element>
                <table-element element-type="th">Modified</table-element>
                <table-element element-type="th"></table-element>
            </tr>
            </thead>
            <tbody>
            <tr v-for="kind in kinds" :key="kind.id">
                <table-element element-type="td">
                    <a :href="'/kind/' + kind.slug"
                       :title="kind.name" v-text="kind.name"/>
                </table-element>
                <table-element element-type="td">{{ kind.description }}</table-element>
                <table-element element-type="td" text-class="has-text-centered">{{ kind.spells.length }}</table-element>
                <table-element element-type="td">{{ kind.created_at | moment('DD.MM.YYYY') }}</table-element>
                <table-element element-type="td">{{ kind.updated_at | moment('DD.MM.YYYY') }}</table-element>
                <table-element element-type="td">
                    <p class="buttons">
                        <a :href="'/kind/' + kind.slug + '/edit'" class="button is-info is-outlined is-small">
                            <span class="icon">
                              <i class="fa fa-edit"></i>
                            </span>
                        </a>
                        <button v-if="!kind.spells.length" @click="openDeleteModal(kind)" class="button is-danger is-outlined is-small">
                            <span class="icon">
                              <i class="fa fa-remove"></i>
                            </span>
                        </button>
                    </p>
                </table-element>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        name: "KindListComponent",
        props: {
            kinds: {
                required: true
            }
        },
        components: {
            TableElement
        },
        methods: {
            openDeleteModal(kind) {
                this.$emit('open-modal',
                    {
                        id: kind.id,
                        title: kind.name,
                        content: 'Do you really want to delete this kind?',
                        url: '/kind/' + kind.slug
                    });
            }
        }
    }
</script>

<style scoped>

</style>
