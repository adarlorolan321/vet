<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { nextTick, ref, defineProps } from "vue";

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);
const user = usePage().props.auth.user;

const props = defineProps({
    data: {
        type: Object,
        default: {},
    },
});

const form = useForm({
    user_id: user.id,
    name: null,
    breed: null,
    age: null,
    gender: null,
    weight: null,
    species: null,
});

const pet_species = [
    "Dogs (Canis lupus familiaris)",
    "Cats (Felis catus)",
    "Fish",
    "Birds",
    "Small Mammals",
    "Reptiles",
    "Amphibians",
    "Rodents",
];

const all_pet_breeds = [
    "Chihuahua",
    "Pomeranian",
    "Dachshund",
    "Yorkshire Terrier",
    "Shih Tzu",
    "French Bulldog",
    "Boston Terrier",
    "Cavalier King Charles Spaniel",
    "Miniature Schnauzer",
    "Pekingese",
    "Labrador Retriever",
    "Golden Retriever",
    "German Shepherd",
    "Bulldog",
    "Beagle",
    "Boxer",
    "Australian Shepherd",
    "Border Collie",
    "Cocker Spaniel",

    "Siamese Cat",
    "Maine Coon Cat",
    "Persian Cat",
    "Bengal Cat",
    "Ragdoll Cat",
    "Sphynx Cat",
    "Abyssinian Cat",
    "Russian Blue Cat",

    "Betta Fish",
    "Goldfish",
    "Guppy",
    "Tetra Fish",
    "Angelfish",
    "Koi",

    "Budgerigar (Budgie)",
    "Cockatiel",
    "African Grey Parrot",
    "Lovebird",
    "Canary",

    "Guinea Pig",
    "Rabbit",
    "Ferret",
    "Hamster",
    "Gerbil",

    "Red-Eared Slider Turtle",
    "Bearded Dragon",
    "Leopard Gecko",
    "Corn Snake",
    "Ball Python",

    "Fire-Bellied Toad",
    "American Bullfrog",
    "Axolotl",

    "Domestic Rat",
    "House Mouse",
    "Gerbil",
    "Chinchilla",
    "Degu",
];

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deletepets = (data) => {
    form.delete(
        route("pets.destroy", data, {
            only: ["data", "params"],

            onSuccess: () => {
               
              
            },
          
        })
    );
    setTimeout(() => {
        window.location.reload();
    }, 100);
   
};

const AddPet = () => {
    form.post(route("pets.store"), {
        preserveScroll: true,

        onSuccess: () => {
            window.location.reload();
        },
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section class="space-y-6 mx-auto">
        <header>
            <h2 class="text-lg font-medium text-gray-900">Pets</h2>
        </header>
        <div class="list">
            <ul v-for="pet in data">
                <hr />
                <li>
                    <strong>Name:</strong> {{ pet.name }}<br />
                    <strong>Breed:</strong> {{ pet.breed }}<br />
                    <strong>Species:</strong> {{ pet.species }}<br />
                    <strong>Age:</strong> {{ pet.age }}<br />
                    <strong>Gender:</strong> {{ pet.gender }}<br />
                    <strong>Weight:</strong> {{ pet.weight }}<br />

                    <!-- Delete and Update Icons -->
                    <span class="pet-icons">
                        <i
                            class="fas fa-trash mr-3"
                            @click="deletepets(pet)"
                        ></i>
                        <!-- <i class="fas fa-edit" onclick="updatePet(1)"></i> -->
                    </span>
                </li>
                <hr />
            </ul>
        </div>
        <PrimaryButton @click="confirmUserDeletion">Add New Pet</PrimaryButton>

        <Modal :show="confirmingUserDeletion" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-gray-900">Pet Details</h2>

                <p class="mt-1 text-sm text-gray-600">
                    Pls. Add the Information of your pet
                </p>

                <div class="d-flex w-full gap-2">
                    <div class="w-full">
                        <InputLabel for="name" value="Name" />

                        <TextInput
                            id="name"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="form.name"
                            required
                            autofocus
                            autocomplete="name"
                        />

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                    <div class="w-100">
                        <InputLabel for="species" value="Species" />

                        <select
                            id="species"
                            class="mt-1 form-control bg-white border-1"
                            v-model="form.species"
                        >
                            <option
                                v-for="species in pet_species"
                                :key="species"
                                :value="species"
                            >
                                {{ species }}
                            </option>
                        </select>

                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>
                </div>
                <div class="d-flex w-full gap-2">
                    <div class="w-100">
                        <InputLabel for="breed" value="Breed" />

                        <select
                            id="breed"
                            class="mt-1 form-control bg-white border-1"
                            v-model="form.breed"
                        >
                            <option
                                v-for="breed in all_pet_breeds"
                                :key="breed"
                                :value="breed"
                            >
                                {{ breed }}
                            </option>
                        </select>
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="w-full">
                        <InputLabel for="age" value="Age" />

                        <TextInput
                            id="age"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.age"
                            required
                            autofocus
                            autocomplete="age"
                        />

                        <InputError class="mt-2" :message="form.errors.age" />
                    </div>
                </div>
                <div class="d-flex w-full gap-2">
                    <div class="w-100">
                        <InputLabel for="gender" value="Gender" />

                        <select
                            id="gender"
                            class="mt-1 form-control bg-white border-1"
                            v-model="form.gender"
                        >
                            <option key="Male" value="Male">Male</option>
                            <option key="Female" value="Female">Female</option>
                        </select>
                        <InputError
                            class="mt-2"
                            :message="form.errors.gender"
                        />
                    </div>

                    <div class="w-full">
                        <InputLabel for="weight" value="Weight" />

                        <TextInput
                            id="weight"
                            type="number"
                            class="mt-1 block w-full"
                            v-model="form.weight"
                            required
                            autofocus
                            autocomplete="weight"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.weight"
                        />
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <SecondaryButton @click="closeModal">
                        Cancel
                    </SecondaryButton>

                    <PrimaryButton
                        class="ml-3"
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing"
                        @click="AddPet"
                    >
                        Add
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </section>
</template>
