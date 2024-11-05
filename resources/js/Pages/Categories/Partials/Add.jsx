import { useRef } from 'react';
import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import SelectBox from '@/Components/SelectBox';
import FileInput from '@/Components/FileInput';
import { useForm } from '@inertiajs/react';
import { Transition } from '@headlessui/react';
import toastr from 'toastr';
export default function AddCategory({ className = '' ,parent_category=[]}) {

    const { data, setData, errors, post, reset, processing, recentlySuccessful } = useForm({
        'name' : '',
        'parent_cat' : '',
        'cat_image' : ''
    });

    // const handleFileChange = (e) => {
    //     setData('image', e.target.files[0]);
    // };

    const addCategory = (e) => {
        e.preventDefault();

        post(route('categories.store'), {
            preserveScroll: true,
            onSuccess: (response) => {

                reset();
            },
            onError: (errors) => {
                // if (errors.password) {
                //     reset('password', 'password_confirmation');
                //     passwordInput.current.focus();
                // }

                // if (errors.current_password) {
                //     reset('current_password');
                //     currentPasswordInput.current.focus();
                // }
            },
        });
    };

    return (
        <section className={className}>
            <header>
                <h2 className="text-lg font-medium text-gray-900">Add Category</h2>
            </header>

            <form onSubmit={addCategory} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="name" value="Category Name" />
                    <TextInput
                        id="name"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                        autoComplete="name"
                    />
                    <InputError message={errors.name} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="parent_cat" value="Parent Category" />
                    <SelectBox
                        id="parent_cat"
                        value={data.parent_cat}
                        onChange={(e) => setData('parent_cat', e.target.value)}
                        className="mt-1 block w-full"
                        autoComplete="parent_cat"
                        options={parent_category}
                    />
                    <InputError message={errors.parent_cat} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="cat_image" value="Category Image" />
                    <FileInput
                        id="cat_image"
                        type="file"
                        onChange={(e) => setData('cat_image', e.target.files[0])}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.cat_image} className="mt-2" />
                </div>

                <div className="flex items-center gap-4">
                    <PrimaryButton disabled={processing}>Save</PrimaryButton>
                    <Transition
                        show={recentlySuccessful}
                        enter="transition ease-in-out"
                        enterFrom="opacity-0"
                        leave="transition ease-in-out"
                        leaveTo="opacity-0"
                    >
                        <p className="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </form>
        </section>
    );
}
