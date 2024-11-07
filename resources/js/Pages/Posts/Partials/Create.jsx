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
import MultipleTagsInput from '@/Components/Inputs/MultipleTagsInput/MultipleTagsInput';
import NewForm from '@/Components/NewForm';
import TextArea from '@/Components/Inputs/TextArea/TextArea';
// import NewForm from '@/Components/NewForm';
export default function CreatePost({ className = '' ,categories=[]}) {

    const { data, setData, errors, post, reset, processing, recentlySuccessful } = useForm({
        'name' : ''
    });

    // const handleFileChange = (e) => {
    //     setData('image', e.target.files[0]);
    // };

    const createPost = (e) => {
        e.preventDefault();
        post(route('posts.store'), {
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
                <h2 className="text-lg font-medium text-gray-900">Add Post</h2>
            </header>

            <form onSubmit={createPost} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="name" value="Post Name" />
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
                    <InputLabel htmlFor="short_name" value="Short Name" />
                    <TextInput
                        id="short_name"
                        value={data.short_name}
                        onChange={(e) => setData('short_name', e.target.value)}
                        type="text"
                        className="mt-1 block w-full"
                        autoComplete="short_name"
                    />
                    <InputError message={errors.short_name} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="category" value="Category" />
                    <SelectBox
                        id="category"
                        value={data.categories}
                        onChange={(e) => setData('category', e.target.value)}
                        className="mt-1 block w-full"
                        autoComplete="category"
                        options={categories}
                    />
                    <InputError message={errors.category} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="excerpt" value="Excerpt" />
                    <TextArea
                        id="excerpt"
                        rows={3}
                        value={data.excerpt}
                        onChange={(e) => setData('excerpt', e.target.value)}
                        className=""
                        autoComplete="excerpt"
                    />
                    <InputError message={errors.excerpt} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="content" value="Content" />
                    <TextArea
                        id="content"
                        rows={3}
                        value={data.content}
                        onChange={(e) => setData('content', e.target.value)}
                        className=""
                        autoComplete="content"
                    />

                    <InputError message={errors.content} className="mt-2" />
                </div>

                <div>
                    <InputLabel htmlFor="tags" value="Add Tags" />
                    <MultipleTagsInput id="tags"/>
                </div>

                <div>
                    <InputLabel htmlFor="image" value="Image" />
                    <FileInput
                        id="image"
                        type="file"
                        onChange={(e) => setData('image', e.target.files[0])}
                        className="mt-1 block w-full"
                    />
                    <InputError message={errors.image} className="mt-2" />
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
