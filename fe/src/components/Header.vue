
<script lang="ts">
// import HeaderLink from './HeaderLink.vue';
// import SideMenu from './SideMenu.vue';
// import Logo from './Logo.vue';
// import Minilogo from './Minilogo.vue';
import { defineComponent } from 'vue';
import {RouterLink} from "vue-router";
import IconLogo from "./icons/IconLogo.vue";

export default defineComponent({
  name: 'Header',
  components: {
    IconLogo,
    RouterLink
  },
  data() {
    return {
      isMenuOpen: false
    };
  },
  methods: {
    toggleMenu() {
      this.isMenuOpen = !this.isMenuOpen;
    }
  }
});
</script>

<template>
  <header>
    <a href="/">
      <div class="logo-container links">
        <IconLogo />
      </div>
      <div class="logo-container menu-button">
        <Minilogo />
      </div>
    </a>
    <nav>
      <button class="menu-button" @click="toggleMenu">
        <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" clip-rule="evenodd"
                d="M20.75 7C20.75 7.41421 20.4142 7.75 20 7.75L4 7.75C3.58579 7.75 3.25 7.41421 3.25 7C3.25 6.58579 3.58579 6.25 4 6.25L20 6.25C20.4142 6.25 20.75 6.58579 20.75 7Z"
                fill="#1C274C" />
          <path fill-rule="evenodd" clip-rule="evenodd"
                d="M20.75 12C20.75 12.4142 20.4142 12.75 20 12.75L4 12.75C3.58579 12.75 3.25 12.4142 3.25 12C3.25 11.5858 3.58579 11.25 4 11.25L20 11.25C20.4142 11.25 20.75 11.5858 20.75 12Z"
                fill="#1C274C" />
          <path fill-rule="evenodd" clip-rule="evenodd"
                d="M20.75 17C20.75 17.4142 20.4142 17.75 20 17.75L4 17.75C3.58579 17.75 3.25 17.4142 3.25 17C3.25 16.5858 3.58579 16.25 4 16.25L20 16.25C20.4142 16.25 20.75 16.5858 20.75 17Z"
                fill="#1C274C" />
        </svg>
      </button>
      <span class="links">
				  <RouterLink to="/">Home</RouterLink>
          <RouterLink to="/about">About</RouterLink>
          <RouterLink to="/contact">Contact</RouterLink>
			</span>
    </nav>
  </header>
  <span v-if="isMenuOpen">
		<SideMenu />
	</span>
</template>

<style scoped>
header {
  padding: 3%;
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
}

.logo-container {
  width: clamp(20%, 80px, 300px);
  display: flex;
  flex-direction: row;
}



.menu-button {
  display: none;
}


@media only screen and (max-width: 1000px) {

  header {
    padding: 5%;
  }

  .menu-button {
    display: block !important;
  }

  .links {
    display: none;
  }
}
</style>
  
