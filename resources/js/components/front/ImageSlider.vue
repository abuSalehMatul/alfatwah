<template>
  <div class="main-section mt-5 container">
    <div class="image-slider-main">
      <div v-for="(image, key) in images" :id="key + '_sliding_img'" 
        :style="key == 0 ? 'display:block': 'display:none'"
        :v-if="image.status == 'active'">
          <img  :src="image.url" />
      </div>
    </div>
  </div>
</template>

<script>
import client from "@/client";
export default {
  name: "image-slider",
  props: ["app_local", 'url'],
  components: {},
  mounted: function () {
    this.startSlide();
    this.getImages();
  },
  data() {
    return {
      images: [],
      timer: null,
      currentIndex: 0,
    };
  },
  methods: {
    startSlide: function () {
      let that = this;
      setInterval(()=>{
        that.currentIndex++;
        if(that.currentIndex >= that.images.length) that.currentIndex = 0;
        for(let i=0 ;i < that.images.length; i++){
          
          $("#"+i+"_sliding_img").hide();
        }
         $("#"+that.currentIndex+"_sliding_img").show(300);
      }, 6000);
    },
    getImages: function(){
      client.get(this.url)
      .then(res => {
         let images =[];
         res.data.forEach(media => {
            images.push(media)
         });
         this.images = images;
      })
    },

    next: function () {
      this.currentIndex += 1;
    },
    prev: function () {
      this.currentIndex -= 1;
    },
  },

  computed: {
    currentImg: function () {
      return this.images[Math.abs(this.currentIndex) % this.images.length];
    },
  },
};
</script>
<style scoped>
.image-slider-main{
  height: 500px;
}
.fade-enter-active,
.fade-leave-active {
  transition: all 0.9s ease-out;
  overflow: hidden;
  visibility: visible;
  /* position: relative; */
  width: 100%;
  opacity: 1;
}

.fade-enter,
.fade-leave-to {
  visibility: hidden;
  height: 0;
  width: 100%;
  opacity: 0;
}

img {
  height: auto;
  max-height: 500px;
  width: 100%;
  display: block;
  margin: auto;
}

</style>

