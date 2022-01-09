<template>
  <div>
      <nav class="navbar navbar-expand-lg bg-white border-bottom navbar-light">
          <router-link class="navbar-brand mr-auto" :to="{name: 'home'}">LaravelBnb</router-link>

          <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                  <router-link class="nav-link" :to="{name: 'basket'}" title="Cart">
                      <i class="fas fa-shopping-cart"></i>
                      <span v-if="itemsInBasket" class="badge alert-basket">{{itemsInBasket}}</span>
                  </router-link>
              </li>

              <li class="nav-item" v-if="!isLoggedIn">
                  <router-link :to="{name: 'login'}" class="nav-link" title="Login">
                      <i class="fas fa-sign-in-alt"></i>
                  </router-link>
              </li>

              <li class="nav-item" v-if="isLoggedIn">
                <div class="dropdown mb-1" title="ProfileBurger">
                    <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <router-link :to="{name: 'home'}" class="dropdown-item nav-link" title="Профиль">
                            Profile
                        </router-link>
                        <a class="dropdown-item nav-link" href="#" @click.prevent="logout">
                            Log Out
                        </a>
                    </div>
                </div>
              </li>
          </ul>
      </nav>

      <div class="container my-4 px-4">
          <router-view></router-view>
      </div>
  </div>
</template>

<script>
import {mapState, mapGetters} from "vuex";
export default {
    name: "Index",
    computed: {
        ... mapState({
            lastSearchComputed: state => state.lastSearch,
            isLoggedIn: state => state.isLoggedIn,
        }),
        ... mapGetters({
            itemsInBasket: 'itemsInBasket',
        })
    },
    methods: {
        async logout() {
            try {
                await axios.post('/logout');
                this.$store.dispatch('logout');
                this.$router.push({ name: "home" });
            }
            catch (error) {
                this.$store.dispatch('logout');
            }
        }
    }
}
</script>

<style scoped>
    .alert-basket {
        background-color: #227dc7;
        color: #ffffff;
        font-weight: bold;
        border-radius: 50%;
    }
</style>