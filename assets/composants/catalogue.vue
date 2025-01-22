<template>
  <div class="body bande-image">
    <img src="/images/catalogue.jpg" alt="Image descriptive">
    <h1 class="titre-mois" @click="chargerCatalogueMoisCourant">Téléchargez le catalogue de {{ moisCourant }}</h1>
  </div>
  <Swiper :slides-per-view="6" :space-between="20">
    <SwiperSlide v-for="(item, index) in items" :key="index">
  <div :class="{'non-cliquable': estFutur(item.mois), 'position-relative': true}">
    <a :href="estFutur(item.mois) ? null : `/images/${item.mois.toLowerCase()}.pdf`" class="download-link" @click.prevent="estFutur(item.mois) ? null : downloadCatalogue(item.mois)">
      <img :src="item.url" :alt="`Image for ${item.mois}`">
      <div class="voile-rouge" v-if="estFutur(item.mois)"></div>
    </a>
    <p class="mois-texte">{{ item.mois }}</p>
  </div>
</SwiperSlide>

  </Swiper>
</template>
<script>
import { ref, onMounted } from 'vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
  import 'swiper/css';
export default {
  components: {
    Swiper, SwiperSlide
  },
  setup() {
    const moisCourant = ref('');
    const items = ref([]);
    const obtenirMoisCourant = () => {
      const mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
      const dateActuelle = new Date();
      moisCourant.value = mois[dateActuelle.getMonth()];
    };

    const estFutur = (mois) => {
    const moisActuel = new Date().getMonth();
    const indexMois = ["janvier", "fevrier", "mars", "avril", "mai", "juin", "juillet", "aout", "septembre", "octobre", "novembre", "decembre"].indexOf(mois.toLowerCase());
    return indexMois > moisActuel;
  };

    const chargerCatalogueMoisCourant = () => {
  // Crée un élément <a> temporaire
  const link = document.createElement('a');
  // Définit l'URL du fichier à télécharger
  link.href = `/images/${moisCourant.value.toLowerCase()}.pdf`;
  // Utilise l'attribut download pour spécifier le nom du fichier téléchargé
  link.download = `Catalogue-${moisCourant.value}.pdf`;
  // Ajoute le lien au document
  document.body.appendChild(link);
  // Déclenche un clic sur le lien
  link.click();
  // Retire le lien du document
  document.body.removeChild(link);
};

      const chargerDonnees = async () => {
        try {
    const response = await fetch('/api/mobile/historiquecatalogue');
    if (!response.ok) throw new Error('Failed to fetch');
    const data = await response.json();
    items.value = data.catalogues;
  } catch (error) {
    console.error('Erreur:', error);
  }
    };

    onMounted(() => {
      obtenirMoisCourant();
      chargerDonnees();
    });
   

    return { items,moisCourant, chargerCatalogueMoisCourant,estFutur  };
  }
};
</script>

<style scoped>
 .body {
    background-color: #2D2D2D;
    }
.bande-image {
  position: relative;
  height: 50vw;
  width: 100vw;
  overflow: hidden;
 
}
.bande-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.titre-mois {
  font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
  text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8); /* Ajoute une ombre portée noire pour améliorer le contraste */

  position: absolute;
  top: 50%; /* Place le titre au milieu verticalement */
  left: 50%; /* Place le titre au milieu horizontalement */
  transform: translate(-45%, -50%); /* Centre précisément en ajustant l'alignement */
  color: white;
  font-size: 3em; /* Augmentez la taille de la police */
  padding: 20px;
  text-align: center;
  cursor: pointer; /* Change le curseur en pointeur */
  max-width: 100%; /* Limite la largeur pour encourager le texte à passer sur deux lignes */
  line-height: 1.2; /* Ajuste l'espacement entre les lignes pour une meilleure lisibilité */
}

.download-link {
  text-decoration: none;
  cursor: pointer;
  display: flex; /* Utilisez flex pour centrer le contenu verticalement et horizontalement */
  flex-direction: column; /* Organise les éléments enfants verticalement */
  align-items: center; /* Centre les éléments enfants horizontalement */
  justify-content: center; /* Centre les éléments enfants verticalement */
}

.mois-texte {
  color: white;
  text-align: center;
  margin-top: 8px; /* Ajustez l'espacement si nécessaire */
}

.position-relative {
  position: relative;
  display: inline-block; /* Ou flex selon le besoin */
}

.voile-rouge {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%; /* Couvre toute la largeur de l'image */
  height: 100%; /* Couvre toute la hauteur de l'image */
  background-color: rgba(255, 0, 0, 0.5);
  z-index: 1;
}

.non-cliquable .download-link {
  pointer-events: none;
}
.swiper {
  width: 100%; /* Utilise toute la largeur disponible */
  height: 200px; /* Ajustez cette valeur selon le besoin */
}
.swiper-slide {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
}

.swiper-slide img {
  max-width: 100px;
  max-height: 100px;
  object-fit: cover;
}


</style>

