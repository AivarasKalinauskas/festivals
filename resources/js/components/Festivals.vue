<template>
    <div>
        <v-form
            ref="form"
            @submit.prevent="addArticle"
        >
            <v-text-field
                v-model="festival.title"
                label="Pavadinimas"
                required
            />

            <v-text-field
                v-model="festival.address"
                label="Adresas"
                required
            />

            <v-text-field
                v-model="festival.date_from"
                label="Nuo"
                required
            />

            <v-text-field
                v-model="festival.date_to"
                label="Iki"
                required
            />

            <v-text-field
                v-model="festival.country_id"
                label="Šalis"
                required
            />

            <v-text-field
                v-model="festival.city_id"
                label="Miestas"
                required
            />

            <v-text-field
                v-model="festival.slug"
                label="Slug"
                required
            />

            <v-textarea
                v-model="festival.description"
                label="Aprašymas"
            />

            <v-btn
                type="submit"
                color="success"
                class="mr-4"
            >
                Įdėti
            </v-btn>
        </v-form>
        <h2>
            Festivals
        </h2>
        <div v-for="festival in festivals" v-bind:key="festival.id">
            <v-card
                class="mx-auto"
            >
                <v-img
                    class="white--text align-end"
                    height="200px"
                    src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                >
                    <v-card-title>{{ festival.title }}</v-card-title>
                </v-img>

                <v-card-subtitle class="pb-0">Number 10</v-card-subtitle>

                <v-card-text class="text--primary">
                    <div>{{ festival.description }}</div>

                    <div>Whitsunday Island, Whitsunday Islands</div>
                </v-card-text>

                <v-card-actions>
                    <v-btn
                        @click="editFestival(festival)"
                        color="green"
                        text
                    >
                        Edit
                    </v-btn>

                    <v-btn
                        @click="deleteFestival(festival.id)"
                        color="red"
                        text
                    >
                        Delete
                    </v-btn>
                </v-card-actions>
            </v-card>
        </div>
        <div class="text-center">
            <v-pagination
                v-model="pagination.current"
                :length="pagination.total"
                @input="onPageChange"
                circle
            />
        </div>
    </div>
</template>

<script>
    export default {
        name: "Festivals",
        data() {
            return {
                festivals: [],
                festival: {
                    id: '',
                    title: '',
                    address: '',
                    place_name: '',
                    date_from: '',
                    date_to: '',
                    description: '',
                    country_id: '',
                    city_id: '',
                    cover: '',
                    video: '',
                    link: '',
                    facebook: '',
                    slug: '',
                },
                festival_id: '',
                pagination: {
                    current: 1,
                    total: 0
                },
                edit: false
            }
        },

        created() {
            this.fetchFestivals();
        },

        methods: {
            fetchFestivals() {
                fetch('/api/festivals?page=' + this.pagination.current)
                    .then(res => res.json())
                    .then(res => {
                        this.festivals = res.data;
                        this.pagination.current = res.meta.current_page;
                        this.pagination.total = res.meta.last_page;
                    })
            },
            onPageChange() {
                this.fetchFestivals();
            },
            deleteFestival(id) {
                if(confirm('Ar tikrai norite ištrinti')) {
                    fetch(`api/festival/${id}`, {
                        method: 'delete'
                    })
                        .then(res => res.json())
                        .then(data => {
                            alert('Festivalis ištrintas');
                            this.fetchFestivals();
                        })
                }
            },
            addArticle() {
              if(this.edit === false) {
                  fetch('api/festival', {
                      method: 'post',
                      body: JSON.stringify(this.festival),
                      headers: {
                          'content-type': 'application/json'
                      }
                  })
                      .then(res => res.json())
                      .then(data => {
                          this.festival.title = '';
                          this.festival.description = '';
                          this.festival.address = '';
                          this.festival.date_from = '';
                          this.festival.date_to = '';
                          this.festival.country_id = '';
                          this.festival.city_id = '';
                          this.festival.slug = '';
                          alert('Festivalis įdėtas');
                          this.fetchFestivals();
                      })
              } else {
                  fetch('api/festival', {
                      method: 'put',
                      body: JSON.stringify(this.festival),
                      headers: {
                          'content-type': 'application/json'
                      }
                  })
                      .then(res => res.json())
                      .then(data => {
                          this.festival.title = '';
                          this.festival.description = '';
                          this.festival.address = '';
                          this.festival.date_from = '';
                          this.festival.date_to = '';
                          this.festival.country_id = '';
                          this.festival.city_id = '';
                          this.festival.slug = '';
                          alert('Festivalis atnaujinatas');
                          this.fetchFestivals();
                      })
              }
            },
            editFestival(festival) {
                this.edit = true;
                this.festival.id = festival.id;
                this.festival.festival_id = festival.id;
                this.festival.title = festival.title;
                this.festival.description = festival.description;
                this.festival.address = festival.address;
                this.festival.date_from = festival.date_from;
                this.festival.date_to = festival.date_to;
                this.festival.country_id = festival.country_id;
                this.festival.city_id = festival.city_id;
                this.festival.slug = festival.slug;
            }
        }
    }
</script>

<style scoped>

</style>
