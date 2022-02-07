<template>
  <div class="w-full max-w-screen-md mx-auto py-8 px-3">
    <div class="flex flex-col mb-3" v-for="field in fields" :key="field.code">
      <label class="mb-2 font-bold text-red-900" :for="field.code">{{
        field.label
      }}</label>
      <input
        v-if="field.type == 'text'"
        class="border border-gray-200 p-2 rounded"
        type="text"
        :id="field.code"
        v-model="newCondominium[field.code]"
      />
      <input
        v-if="field.type == 'number'"
        class="border border-gray-200 p-2 rounded"
        type="number"
        :id="field.code"
        v-model="newCondominium[field.code]"
      />
      <select
        v-if="field.type == 'select'"
        class="border border-gray-200 p-2 rounded bg-white"
        :name="field.code"
        :id="field.code"
        v-model="newCondominium[field.code]"
      >
        <option
          v-for="option in field.options"
          :key="option.code"
          :value="option.code"
        >
          {{ option.label }}
        </option>
      </select>
      <textarea
        v-if="field.type == 'text'"
        v-model="newCondominium[field.code]"
        class="border border-gray-200 p-2 rounded bg-white"
        :id="field.code"
        cols="30"
        rows="10"
      >
      </textarea>
    </div>
    <div class="pt-3">
      <button
        @click="createCondominium()"
        :disabled="!formIsValid"
        class="
          disabled:bg-gray-300 disabled:cursor-not-allowed
          p-2
          px-3
          rounded
          bg-red-800
          text-white
        "
      >
        {{ $route.name == "edit_Condominium" ? "Salva" : "Crea" }}
      </button>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "CreateCondominium",
  data() {
    return {
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
        province:"",
        address:"",
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
    if (this.$route.name == "edit_Condominium") {
      let response = await axios.get(
        "http://localhost:8000/api/Condominiums/" + this.$route.params.id
      );
      this.newCondominium = response.data;
    }
  },
  methods: {
    async createCondominium() {
      if (this.$route.name == "edit_Condominium") {
        let response = await axios.put(
          "http://localhost:8000/api/Condominiums/" + this.$route.params.id,
          this.newCondominium
        );

        if (response.status == 200) {
          this.$router.push("/");
        }
      } else {
        let response = await axios.post(
          "http://localhost:8000/api/Condominiums",
          this.newCondominium
        );

        if (response.status == 201) {
          this.$router.push("/");
        }
      }
    },
  },
  computed: {
    formIsValid() {
      return (
        this.newCondominium.name != "" &&
        this.newCondominium.photo != "" &&
        this.newCondominium.number_cond > 0 &&
        this.newCondominium.accounting != "" &&
        this.newCondominium.address != "" &&
        this.newCondominium.province != ""
      );
    },
  },
};
</script>
