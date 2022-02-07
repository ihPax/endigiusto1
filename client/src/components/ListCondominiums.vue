<template>
  <div class="w-full max-w-screen-md mx-auto pt-8">
    <div class="flex items-center mb-5">
      <div class="ml-auto mr-3">Ordina per quantità:</div>
      <span
        class="rounded-lg p-2 uppercase text-xs mr-2 cursor-pointer"
        :class="{
          'bg-red-200 text-red-900': sortMethod == 'asc',
          'bg-gray-300 text-gray-800': sortMethod != 'asc',
        }"
        @click="sort('asc')"
        >Crescente</span
      >
      <span
        class="rounded-lg p-2 uppercase text-xs cursor-pointer"
        :class="{
          'bg-red-200 text-red-900': sortMethod == 'desc',
          'bg-gray-300 text-gray-800': sortMethod != 'desc',
        }"
        @click="sort('desc')"
        >Decrescente</span
      >
    </div>
    <div class="grid grid-cols-3 gap-x-5 gap-y-5">
      <div
        class="bg-gray-200 rounded flex flex-col p-3"
        v-for="condominium in condominiums"
        :key="condominium.id"
      >
        <div
          class="h-56 w-full bg-white cursor-pointer"
          @click="goToDetail(condominium)"
        >
          <img class="w-full h-full" :src="condominium.photo" alt="" />
        </div>
        <div class="flex flex-row items-center pt-3">
          <div class="flex-grow">
            {{ condominium.name }}
          </div>
          <div class="flex">
            <h2 class="ml-auto text-green-600 font-bold text-xl">
              {{ condominium.comune }}
            </h2>
          </div>
        </div>
        <div class="mt-3 ml-auto space-x-3">
          <button
            class="text-yellow-600 text-sm font-bold"
            @click="edit(condominium)"
          >
            Modifica
          </button>
          <button
            class="text-red-600 text-sm font-bold"
            @click="deleteCondominium(condominium)"
          >
            Elimina
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ListCondominiums",
  data() {
    return {
      condominiums: [],
      sortMethod: "asc",
    };
  },
  async mounted() {
    await this.getCondominiums();
  },
  methods: {
    async getCondominiums() {
      let response = await axios.get(
        "http://localhost:8000/api/condominiums?sort=" + this.sortMethod
      );
      this.condominiums = response.data;
    },
    edit(condominium) {
      this.$router.push("/edit/" + condominium.id);
    },
    goToDetail(condominium) {
      this.$router.push("/view/" + condominium.id);
    },
    async deleteCondominium(condominium) {
      if (
        confirm(
          "Vuoi davvero eliminare il condominio: " + condominium.name + "?",
          "Si",
          "No"
        )
      ) {
        await axios.delete("http://localhost:8000/api/condominiums/" + condominium.id);
        await this.getCondominiums();
      }
    },
    sort(direction) {
      if (this.sortMethod != direction) {
        this.sortMethod = direction;
        this.getCondominiums();
      }
    },
  },
};
</script>
