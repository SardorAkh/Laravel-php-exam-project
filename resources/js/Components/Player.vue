<template>
  <div class="fixed inset-0 bg-black bg-opacity-25 flex items-center justify-center"
       @click.self="$emit('playerClose')">
    <div class="bg-secondary text-white w-2/5">
      <div class="w-full flex justify-end pt-2 px-4 mb-8">
        <button @click="$emit('playerClose')">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 transition-all hover:stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
      <div v-if="error" class="text-red-600 font-semibold text-xl">
        {{error}}
      </div>
<!--Track progress-->
      <div class="flex px-8">
        {{trackLapse}}
        <div id="seekBar"
             class="w-full border border-white py-2 relative z-25 mx-1 rounded overflow-hidden">
          <div>
            <div id="seekPosition" class="absolute left-0 top-0 bottom-0 bg-primary"></div>
            <div class="absolute inset-0 cursor-pointer" @click.self="seek($event)"></div>
          </div>
        </div>
        {{timeFormat(duration)}}
      </div>

<!-- Controllers-->
      <div class="flex py-2 px-8 items-center justify-between">
        <div class="flex items-center">
          <button v-if="!isSongPlaying" @click="play" class="h-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 transition-all hover:stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />

              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
            </svg>
          </button>

          <button v-else @click="pause" class="h-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 transition-all hover:stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
          </button>
          <button @click="stop" class="h-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 transition-all hover:stroke-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
            </svg>
          </button>
        </div>
        <div class="flex">
          <div>
            <svg
              v-if="volume"
              xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" />
            </svg>
            <svg
              v-else
              xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" clip-rule="evenodd" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" />
            </svg>
          </div>
          <input type="range" min="0" max="1" step="0.02" v-model.number="volume">
        </div>
      </div>

      <div class="flex justify-end p-2 pb-6 px-8">
        <button class="flex transition-all hover:text-primary">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hover:stroke-primary" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
        download
        </button>
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
        error: null,
      }
    },
    methods: {
      seek(e) {
        let seekBarWidth = e.target.offsetWidth;
        let clickedPoint = e.offsetX;
        let oneSecondInSeekBar = seekBarWidth / this.duration;
        let seekSeconds = clickedPoint / oneSecondInSeekBar;

        this.song.seek(seekSeconds);
        this.timer = seekSeconds;
      },
      play() {
        this.song.play();
        this.isSongPlaying = true;

      },
      pause() {
        this.song.pause();
        this.isSongPlaying = false;

      },
      stop() {
        this.song.stop();
        this.isSongPlaying = false;

      },
      timeFormat(time) {
        time = Math.floor(time);
        let minutes = Math.floor(time / 60);
        let seconds = time % 60;
        return `${minutes < 10 ? '0' + minutes : minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
      },

      keyPressEvent(e) {
        console.log(e)
      }

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
      },

    },
    watch: {
      timer(time) {
        let seekBarWidth = document.getElementById('seekBar').offsetWidth
        let oneSecondInSeekBar = seekBarWidth / this.duration
        document.getElementById('seekPosition').style.width = time * oneSecondInSeekBar + "px";
      },
      volume(volume) {
        this.song.volume(volume);
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
          this.isSongPlaying = false;
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
