<template>
  <div class="flex items-center p-3 bg-yellow-200">
    <div @click="goToList()" class="cursor-pointer">
      <span class="text-black"> ENDI </span>
    </div>
    <div class="ml-auto">
      <button @click="createCondominium()" class="p-2 text-green-900">
        Aggiungi un condominio
      </button>
    </div>
  </div>
</template>
<script>
export default {
  name: "Navigation",
  methods: {
    createCondominium() {
      this.$router.push({
        name: "create_Condominium",
      });
    },
    goToList() {
      this.$router.push({
        name: "list_condominiums",
      });
    },
  },
};
</script>
