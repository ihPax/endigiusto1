<template>
  <div class="w-full max-w-screen-md mx-auto py-8 px-3">
    <div class="flex items-end">
      <h1 class="font-bold text-3xl">{{ condominium.name }}</h1>
      <h2 class="ml-auto text-green-600 font-bold text-2xl">
        {{ condominium.number_cond }}
      </h2>
    </div>
    <div class="flex mt-5 items-stretch">
      <div class="h-56 w-56 w-full bg-white cursor-pointer mr-8">
        <img class="w-full h-full" :src="condominium.photo" alt="" />
      </div>
      <div class="flex flex-col justify-between flex-grow">
        <div
          v-for="field in fields"
          :key="field.code"
          class="border-b border-gray-600 flex items-center"
        >
          <span>
            {{ field.label }}
          </span>
          <span class="ml-auto font-bold">
            {{ condominium[field.code] }}
          </span>
        </div>
      </div>
    </div>
    <div>
      <button
        @click="goToList()"
        class="text-gray-500 text-sm cursor-pointer mt-5"
      >
        Torna indietro
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "ViewCondominium",
  data() {
    return {
      condominium: {},
      fields: [
        {
          label: "Nome",
          code: "name",
          type: "text",
        },
        {
          label: "Foto",
          code: "photo",
          type: "text",
        },
        {
          label: "Comune",
          code: "common",
          type: "text",
        },
        {
          label: "Provincia",
          code: "province",
          type: "text",
        },
        {
          label: "Indirizzo",
          code: "address",
          type: "text",
        },
        {
          label: "CAP",
          code: "cap",
          type: "number",
        },
        {
          label: "Numero condomini",
          code: "number_cond",
          type: "number",
        },
        {
          label: "Consumo complessimo dell'ultimo anno",
          code: "consumption",
          type: "number",
        },
        {
          label: "Gestione remota",
          code: "remote",
          type: "checkout",
        },
        {
          label: "Tipo di contabilizzazione",
          code: "accounting",
          type: "select",
          options: [
            {
              label: "Diretta",
              code: "diretta",
            },
            {
              label: "Indiretta",
              code: "indiretta",
            },
          ],
        },
        {
          label: "Tipologia sonda",
          code: "probe",
          type: "select",
          options: [
            {
              label: "Compatta",
              code: "compatta",
            },
            {
              label: "Remote",
              code: "remote",
            },
          ],
        },
        {
          label: "Tipologia dispositivi",
          code: "device",
          type: "select",
          options: [
            {
              label: "Ripartitori di calore",
              code: "ripartitori",
            },
            {
              label: "Totalizzatore di calore",
              code: "totalizzatore",
            },
            {
              label: "Contatore di energia termica",
              code: "contatore",
            },
          ],
        },
      ],
      newCondominium: {
        name: "",
        photo: "",
        common: "",
        province: "",
        address: "",
        cap: 0,
        number_cond: 0,
        consumption: 0,
        remote: "",
        accounting: "diretta",
        probe: "Compatta",
        device: "Ripartitori di calore",
      },
    };
  },
  async mounted() {
    let condominiumId = this.$route.params.id;

    let response = await axios.get(
      "http://localhost:8000/api/condominiums/" + condominiumId
    );
    console.log(response);
    this.condominium = response.data;
  },
  methods: {
    goToList() {
      this.$router.push("/");
    },
  },
};
</script>
