<template>

    <div class="container">
        <div class="alert alert-warning alert-dismissible fade show"
             role="alert"
             v-if="Msg">
            {{ Msg }}
            <button type="button" class="close" @click="clearMsg()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <FormulateForm
                            @submit="sendRecipe"
                            v-model="formValues">
                            <FormulateInput

                                type="text"
                                label="Название блюда"
                                name="name"
                                id="name"
                                validation-name="Название блюда"
                                :validation-messages="{
                                    required: 'Пожалуйста введите название блюда'
                                     }"
                                error-class="errorMessage"
                                validation="required|max:255"
                                wrapper-class="form-group row"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control"
                                errors-class="col-md-8 offset-md-3"/>


                            <FormulateInput
                                :options="{1: '1'}"
                                wrapper-class='form-group row'
                                type="select"
                                placeholder="Выбирите тип рецепта"
                                label="Тип рецепта"
                                name="type_recipe"
                                validation="required|max:255"
                                error-class="errorMessage"
                                :validation-messages="{
                                    required: 'Пожалуйста выберите тип блюда'
                                }"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control"
                                errors-class="col-md-8 offset-md-3"
                            />

                            <FormulateInput
                                :options="{1: 'Легко', 2: 'Нормально', 3: 'Сложно'}"
                                wrapper-class='form-group row'
                                type="select"
                                placeholder="Выбирите сложность"
                                label="Сложность"
                                name="difficulty"
                                validation="required|max:255"
                                error-class="errorMessage"
                                :validation-messages="{
                                    required: 'Пожалуйста выберите сложность приготовления.'
                                }"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control"
                                errors-class="col-md-8 offset-md-3"
                            />
                            <div class="old_image"><img :src="recipe.recipe.photo_head" width="47" height="47"></div>
                            <FormulateInput
                                type="image"
                                name="image"
                                id="image"
                                label="Изображение блюда"
                                validation="mime:image/jpeg,image/png,image/gif|required"
                                validation-name="Изображение блюда"
                                upload-behavior="delayed"
                                :validation-messages="{
                         required: 'Добавьте изображение Вашего блюда'
                         }"
                                wrapper-class="form-group row image_input"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control border-0"
                                errors-class="col-md-8 offset-md-3"
                                error-class="errorMessage"
                            />

                            <FormulateInput
                                type="number"
                                label="Калории"
                                name="kkal"
                                id="kkal"
                                validation-name="Калории"
                                validation="required|number"
                                :validation-messages="{
                                        required: 'введите предпологаемое количество каллорий'}"
                                wrapper-class="form-group row"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control"
                                errors-class="col-md-8 offset-md-3"
                                error-class="errorMessage"/>

                            <FormulateInput
                                type="number"
                                label="Количество порции"
                                name="portion_count"
                                id="portion_count"
                                validation-name="Количество порции"
                                validation="required|number"
                                :validation-messages="{
                                        required: 'введите предполагаемое количество порции'}"
                                wrapper-class="form-group row"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control"
                                errors-class="col-md-8 offset-md-3"
                                error-class="errorMessage"/>

                            <FormulateInput
                                type="textarea"
                                label="Описание"
                                name="description"
                                id="description"
                                validation-name="Описание"
                                :validation-messages="{
                         required: 'введите Описание рецепта'
                         }"

                                validation="required"
                                wrapper-class="form-group row"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control"
                                errors-class="col-md-8 offset-md-3"
                                error-class="errorMessage"
                            />

                            <FormulateInput
                                type="number"
                                label="Время приготовления (мин)"
                                name="cooking_time"
                                id="cooking_time"
                                validation-name="Время приготовления"
                                :validation-messages="{
                         required: 'введите время приготовления',
                         number:'Введите время приготовления в минутах',

                         }"
                                validation="required|number"
                                wrapper-class="form-group row"
                                label-class="col-md-3 col-form-label text-md-right"
                                element-class="col-md-9"
                                input-class="form-control"
                                errors-class="col-md-8 offset-md-3"
                                error-class="errorMessage"
                            />

                            <ul class="product-list">
                                <li v-for="product in recipe.recipe.products" :key="product.id">
                                    {{ product.name }} - {{ product.pivot.quantity }}
                                    <a href="#">X</a>
                                </li>
                            </ul>

                            <FormulateInput
                                v-model="products"
                                type="group"
                                name="products"
                                :repeatable="true"
                                label="Добавьте продукты"
                                add-label="+ Добавить продукт"
                                element-class="col-md-12"
                                @popup="PopUpShow"
                            >
                                <div class="product">
                                    <FormulateInput
                                        type="autocomplete"
                                        name="product_id"
                                        validation="required"
                                        label="Название продукта"
                                        element-class="product-name"
                                        @popup="PopUpShow"
                                    />
                                    <FormulateInput
                                        name="quantity"
                                        validation="required"
                                        label="Кол-во"
                                        element-class="product-quantity"
                                    />
                                    <FormulateInput
                                        name="productCount"
                                        label="Единица измерения"
                                        element-class="product-count"
                                        disabled
                                    />
                                </div>
                            </FormulateInput>
                            <FormulateInput
                                checked
                                type="checkbox"
                                name="is_active"
                                label="Сделать ваш рецепт доступным для всех"
                                wrapper-class="form-group row"
                                label-class="form-check-label"
                                outer-class="col-md-6 offset-md-4"
                                input-class="form-check-input"
                                errors-class="col-md-3 offset-md-3"
                            />

                            <!--
                            <div class="form-group row mb-2">
                                <div class="col-md-8 offset-md-4">
                                    <button type="button" class="button" id="steps" name="steps">
                                        Этапы рецепта
                                    </button>

                                </div>
                            </div>
                            -->

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="button">
                                        Редактировать рецепт
                                    </button>

                                </div>
                            </div>
                        </FormulateForm>
                        <!--Pop-up  окно -->
                        <div class="b-popup hide-popup justify-content-center" id="popup1">
                            <div class="b-popup-content">
                                <a href="#" v-on:click="PopUpHide()" class="close">x</a>

                                <FormulateForm
                                    name="addProductForm"
                                    @submit="sendProduct"
                                    v-model="productFormValues">
                                    <FormulateInput
                                        type="text"
                                        label="Название продукта"
                                        name="nameProduct"
                                        id="name"
                                        validation-name="Название продукта"
                                        :validation-messages="{
                                    required: 'Пожалуйста введите название продукта'
                                     }"
                                        error-class="errorMessage"
                                        validation="required|max:255"
                                        wrapper-class="form-group row"
                                        label-class="col-md-3 col-form-label text-md-right"
                                        element-class="col-md-9"
                                        input-class="form-control"
                                        errors-class="col-md-8 offset-md-3"/>


                                    <FormulateInput
                                        :options="{1: '1', 2: '2'}"
                                        wrapper-class='form-group row'
                                        type="select"
                                        placeholder="Выбирите тип продукта"
                                        label="Тип продукта"
                                        name="type_product"
                                        validation="required|max:255"
                                        error-class="errorMessage"
                                        :validation-messages="{
                                    required: 'Пожалуйста выберите тип продукта'
                                }"
                                        label-class="col-md-3 col-form-label text-md-right"
                                        element-class="col-md-9"
                                        input-class="form-control"
                                        errors-class="col-md-8 offset-md-3"
                                    />

                                    <FormulateInput
                                        :options="{1: 'грамм', 2: 'литр'}"
                                        wrapper-class='form-group row'
                                        type="select"
                                        placeholder="Выбирите единицу измерения"
                                        label="Единица измерения"
                                        name="type_quantity"
                                        validation="required|max:255"
                                        error-class="errorMessage"
                                        :validation-messages="{
                                    required: 'Пожалуйста выберите единицу измерения.'
                                }"
                                        label-class="col-md-3 col-form-label text-md-right"
                                        element-class="col-md-9"
                                        input-class="form-control"
                                        errors-class="col-md-8 offset-md-3"
                                    />

                                    <FormulateInput
                                        type="image"
                                        name="image"
                                        id="image"
                                        label="Изображение продукта"
                                        validation="mime:image/jpeg,image/png,image/gif|required"
                                        validation-name="Изображение продукта"
                                        upload-behavior="delayed"
                                        :validation-messages="{
                         required: 'Добавьте изображение продукта'
                         }"
                                        wrapper-class="form-group row"
                                        label-class="col-md-3 col-form-label text-md-right"
                                        element-class="col-md-9"
                                        input-class="form-control border-0"
                                        errors-class="col-md-8 offset-md-3"
                                        error-class="errorMessage"
                                    />

                                    <FormulateInput
                                        checked
                                        type="checkbox"
                                        name="is_active"
                                        label="Сделать ваш продукт доступным для всех"
                                        wrapper-class="form-group row"
                                        label-class="form-check-label"
                                        outer-class="col-md-6 offset-md-4"
                                        input-class="form-check-input"
                                        errors-class="col-md-3 offset-md-3"
                                    />


                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="button">
                                                Добавить продукт
                                            </button>

                                        </div>
                                    </div>
                                </FormulateForm>

                </div>
            </div>
        </div>
    </div>
            </div>
        </div>
    </div>
            </template>

<script>
    export default {
        name: "UpdateRecipe",
        title: "Редактировать рецепт",
        data() {
            return {
                loading: false,
                recipe: {},
                error: null,
                id: this.$route.params.id,
                formValues: {},
                searchResult: [],
                Msg: "",
                searchQuery: "",
                products: [],
                productFormValues: {},
                selectedProductId: null,
            }
        },
        created() {
            this.getRecipe();
        },
        methods: {
            getRecipe() {
                this.loading = true;
                console.log(this.id);
                axios
                    .get('/api/recipes/' + this.id)
                    .then(response => {
                        this.recipe = response.data;
                        console.log(this.recipe);
                            this.formValues = {
                                'name': this.recipe.recipe.name,
                               'kkal': parseInt(this.recipe.recipe.kkal),
                                'cooking_time': parseInt(this.recipe.recipe.cooking_time),
                                'portion_count':parseInt(this.recipe.recipe.portion_count),
                                'type_recipe': this.recipe.recipe.type_recipe,
                                'description':this.recipe.recipe.description,
                                'difficulty': this.recipe.recipe.difficulty,
                                'is_active': this.recipe.recipe.is_active,
                                'image':this.recipe.recipe.photo_head,
                            };

                            //console.log(this.recipe);
                            //console.log(this.formValues);

                        })
                        .catch(error => {
                            this.error = true;
                            this.message = error.message;
                        });
            },

            clearMsg() {
                this.Msg = ""
            },
            sendRecipe(data) {

                if (!data.is_active) {
                    data.is_active = 0;
                }

                data.photo_head = data.image[0].url;
                data.user_id = window.auth.userId;
                console.log(this.id);
                axios
                    .post("/api/recipes/update/"+this.id, data)
                    .then((response) => {
                        this.$router.push({name: 'show-recipe', params: {id: response.data.id}})
                    }).catch(err => {
                    this.Msg = err.data.message;
                    console.log(err.data);
                })
            },
            searchProduct(query) {

                if (query.length < 3) {
                    return;
                }

                const queryUrl = '/api/product/search';
                axios
                    .post(queryUrl, {searchString: query}, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.data.length === 0) {
                            this.searchResult = [];
                            this.visible = true;
                        }

                        this.searchResult = [];

                        for (const item of response.data) {
                            this.searchResult.push({
                                value: item.id,
                                label: item.name
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },

            searchProduct(query) {
                if (!query || query.length < 3) {
                    return;
                }

                const queryUrl = '/api/product/search';
                axios
                    .post(queryUrl, {searchString: query}, {
                        headers: {
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.data.length === 0) {
                            this.searchResult = [];
                            this.visible = true;
                        }

                        this.searchResult = [];

                        for (const item of response.data) {
                            this.searchResult.push({
                                value: item.id,
                                label: item.name
                            });
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            inputSelected(value) {
                this.selectedProductId = value.id;
            },
            getTypeQuantity() {

            },
            PopUpHide() {
                $("#popup1").addClass('hide-popup');
            },
            PopUpShow() {
                $("#popup1").removeClass('hide-popup');
            },
            sendProduct(data) {
                if (!data.is_active) {
                    data.is_active = 0;
                }

                data.image = data.image[0].url;
                data.name = data.nameProduct;

                axios
                    .post("/api/product/store", data)
                    .then((response) => {
                        data.name = '';

                        this.PopUpHide();
                        this.$formulate.reset('addProductForm');
                        // this.Msg = "Ваш продукт добавлен";
                    }).catch(err => {
                    // this.Msg = err.data.message;
                    console.log(err.data);
                });
            },
        }
    }
</script>

<style>
    .product-list{
        display: inline-block;
    }
    .product-list li{
        padding: 5px 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .product-list li a{
        padding: 0 5px;
        margin-left: 10px;
    }
    .errorMessage {
        width: 100%;
        margin-top: -1rem;
        margin-bottom: 1rem;
        font-size: 90%;
        color: #e3342f !important;
    }

    .product {
        display: flex;
        flex-flow: row nowrap;
        justify-content: space-between;
        flex: 0 0 25%;
    }

    .product .formulate-input:nth-child(1) {
        flex-basis: 50%;
    }
    .old_image{
        float: right;
    }
</style>
