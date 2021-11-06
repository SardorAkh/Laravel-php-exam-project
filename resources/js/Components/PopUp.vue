<template>
    <div
      id="popUp"
      v-if="isShow"
      :class="opacity"
      class="fixed bottom-0 right-10 px-8 py-2 bg-primary text-secondary border border-secondary">
      {{ message }}
      <button
        class="absolute right-0"
        @click="changeStateIsShow">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
      </button>
    </div>
</template>

<script>
  export default {
    name: "PopUp",
    props: {
      message: String
    },
    data() {
      return {
        isShow: true,
        opacityAmount: 100,
        interval : null,
        timeout: null,
      }
    },
    methods: {
      changeStateIsShow() {
        this.isShow = !this.isShow;
      },
      changeOpacityAmount() {
        this.opacityAmount -= 25;
      },
      setSchedules() {
        this.timeout = setTimeout(this.changeStateIsShow, 5000)
        this.interval = setInterval(this.changeOpacityAmount, 1000)
      },
      clearSchedules() {
        this.opacityAmount = 100;
        clearTimeout(this.timeout)
        clearInterval(this.interval)
      },
      setEvents() {
        let el = document.getElementById('popUp')
        el.addEventListener('mouseover', this.clearSchedules)
        el.addEventListener('mouseout', this.setSchedules)
      },
      clearEvents() {
        let el = document.getElementById('popUp')
        removeEventListener('mouseover', this.clearSchedules)
        removeEventListener('mouseout', this.setSchedules)
      }
    },
    computed: {
      opacity() {
       return {
         'opacity-100' : this.opacityAmount === 100,
         'opacity-75' : this.opacityAmount === 75,
         'opacity-50' : this.opacityAmount === 50,
         'opacity-25' : this.opacityAmount === 25,
         'opacity-0' : this.opacityAmount === 0,
       }
      }
    },
    mounted() {
      this.setSchedules()
      this.setEvents()
    },
    unmounted() {
      this.clearSchedules()
      this.clearEvents()
    }
  }
</script>

<style scoped>

</style>
