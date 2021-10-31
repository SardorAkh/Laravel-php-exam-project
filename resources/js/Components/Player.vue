<template>
  <div class="fixed inset-0 bg-black bg-opacity-25 flex items-center justify-center" @click.self="$emit('playerClose')">
    <div class="bg-secondary text-white w-2/5">
      <div v-if="error" class="text-red-600 font-semibold text-xl">
        {{error}}
      </div>
      <div class="flex">
        <div class="flex items-center">
          <button v-if="!isSongPlaying" @click="play">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </button>
          <button v-else @click="pause">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </button>
          <button @click="stop">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
            </svg>
          </button>
        </div>
        <div class="">
          {{trackLapse}}
          <input type="range" min="0" :max="duration"  @change="seeking($event)" :value="timer">
          {{timeFormat(duration)}}
        </div>
        <div>
          volume: <input type="range" min="0" max="1" step="0.02" @change="changeVolume($event)" :value="volume">
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import {Howl, Howler} from 'howler'
  export default {
    name: "Player",
    props: {
      soundUrl: {
        type: String,
      },
    },
    data() {
      return {
        song: null,
        isSongPlaying: false,
        volume : null,
        duration : 0,
        interval : null,
        timer: 0,
        error: null
      }
    },
    methods: {
      play() {
        this.song.play();
        this.isSongPlaying = true;
        // this.interval = setInterval(() => {
        //   this.timer++;
        // },1000)
      },
      pause() {
        this.song.pause();
        this.isSongPlaying = false;
        // clearInterval(this.interval)
      },
      stop() {
        this.song.stop();
        this.isSongPlaying = false;
        // clearInterval(this.interval)
      },
      seeking(e) {
        this.song.seek(e.target.value);
        this.timer = e.target.value;
      },
      changeVolume(e) {
        this.song.volume(e.target.value);
        this.volume = e.target.value;
      },
      timeFormat(time) {
        time = Math.floor(time);
        let minutes = Math.floor(time / 60);
        let seconds = time % 60;
        return `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
      },

    },

    computed: {
      trackLapse() {
        let minutes = 0;
        let seconds = 0;
        let i = 0;
        while(i < this.timer) {
          seconds++;
          if(seconds === 60) {
            minutes++;
            seconds = 0;
          }
          i++
        }
        return `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
      }
    },
    mounted() {
      this.song = new Howl({
        src:this.soundUrl,
        html5: true,
        preload: true,
        onloaderror: () => {
          this.error = "Something goes wrong"
        },
        onload: () => {
          this.duration = Math.floor(this.song.duration())
          this.volume = this.song.volume();
        },
        onplay: () => {
          this.interval = setInterval(_ => {
            this.timer++;
          }, 1000);
        },
        onpause: () => {
          clearInterval(this.interval);
        },
        onstop: () => {
          clearInterval(this.interval);
          this.timer = 0
        },
        onend: () => {
          clearInterval(this.interval);
          this.timer = 0;
        }
      });
      document.body.style.height = '100%';
      document.body.style.overflow = 'hidden';

    },
    unmounted() {
      Howler.unload();
      document.body.style.height = '';
      document.body.style.overflow = '';
    }

  }
</script>

<style></style>
