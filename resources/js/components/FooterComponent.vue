<template>
    <footer class="footer">
        <div class="footer__menu">
            <ul>
                <li class="footer__menu-item">
                    <router-link :to="{name: 'home'}" class="footer__menu-link">Главная</router-link>
                </li>
                <li class="footer__menu-item">
                    <router-link :to="{name: 'recipes', query: {page: 1}}" class="footer__menu-link">Каталог рецептов
                    </router-link>
                </li>
                <li v-if="authenticated && user" class="footer__menu-item">
                    <router-link :to="{name: 'my-recipes', query: {page: 1}}" class="footer__menu-link">Мои рецепты
                    </router-link>
                </li>
                <li v-if="authenticated && user" class="footer__menu-item">
                    <router-link :to="{name: 'add-recipe'}" class="footer__menu-link">Добавить рецепт</router-link>
                </li>
            </ul>
        </div>
        <div class="footer__social">
            <ul>
                <li class="footer__social-item"><a href="#" class="footer__social-link"><img
                    src="/images/social/footer-facebook.svg" alt="Facebook" class="footer__social-img"></a></li>
                <li class="footer__social-item"><a href="#" class="footer__social-link"><img
                    src="/images/social/footer-instagram.svg" alt="Instagram" class="footer__social-img"></a>
                </li>
                <li class="footer__social-item"><a href="#" class="footer__social-link"><img
                    src="/images/social/footer-twitter.svg" alt="Google" class="footer__social-img"></a></li>
            </ul>
        </div>
    </footer>
</template>

<script>
    export default {
        name: "Footer",
        props: ['authenticated', 'user'],
    }
</script>

<style scoped>

</style>
