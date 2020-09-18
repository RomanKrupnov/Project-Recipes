<template>
    <div
        :class="`formulate-input-element formulate-input-element--${context.type}`"
        :data-type="context.type"
    >
        <v-select
            v-model="selected"
            v-bind="context.attributes"
            :filterable="false"
            :options="options"
            label="name"
            @search="onSearch"
            @input="setSelected"
        >
            <template slot="no-options">
                <li @click="addProductEvent" :style="{cursor: 'pointer'}">Добавить продукт</li>
            </template>
            <template slot="option" slot-scope="option">
            </template>
            <template slot="selected-option" slot-scope="option">
            </template>
        </v-select>
        <input type="hidden"
               v-model="context.model"
               v-bind="context.attributes"
               :name="context.attributes.name"
        />
    </div>
</template>

<script>
    export default {
        name: "Autocomplete",
        props: {
            context: {
                type: Object,
                required: true
            },
        },
        data() {
            return {
                options: [],
                selected: '',
            }
        },
        methods: {
            onSearch(search, loading) {
                loading(true);
                this.search(loading, search, this);
            },
            search: _.debounce((loading, search, vm) => {

                const queryUrl = '/api/product/search';
                axios
                    .post(queryUrl, {searchString: search}, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        vm.options = response.data;
                        loading(false);
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }, 350),
            setSelected(value) {
                this.context.model = value.id;
                this.selected = value.name;
                this.$emit('selected', value);
            },
            addProductEvent(e) {
                this.$emit('popup', e);
            }
        },
        computed: {
            model() {
                return this.context.model
            },
        }
    }
</script>

<style scoped>
    img {
        height: auto;
        max-width: 2.5rem;
        margin-right: 1rem;
    }

    .d-center {
        display: flex;
        align-items: center;
    }

    .selected img {
        width: auto;
        max-height: 23px;
        margin-right: 0.5rem;
    }

    .v-select .dropdown li {
        border-bottom: 1px solid rgba(112, 128, 144, 0.1);
    }

    .v-select .dropdown li:last-child {
        border-bottom: none;
    }

    .v-select .dropdown li a {
        padding: 10px 20px;
        width: 100%;
        font-size: 1.25em;
        color: #3c3c3c;
    }

    .v-select .dropdown-menu .active > a {
        color: #fff;
    }
</style>
