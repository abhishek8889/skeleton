import React, { useState } from 'react';
import LinkBox from '../../Components/LinkBox';
import DangerButton from '../../Components/DangerButton';
import axios from 'axios';

export default function Table({ tagHeader, posts: initialPosts , editRoute , deleteRoute }) {

    const [posts, setPosts] = useState(initialPosts);
    const deleteRow = (deleteRou ,id) =>{
        if (window.confirm('Are you sure you want to delete this row?')) {
        
            axios.post(deleteRou)
            .then(function (response) {
                console.log(response);
                setPosts((prevPosts) => prevPosts.filter((post) => post.id !== id));
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }


    return (
        <>
            <table className="table">
                <thead>
                    <tr>
                       {tagHeader.map((header)=> (
                            <th scope="col">{header}</th>
                        ))}
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                        {posts.map((post ,postIndex)=> (
                            <tr key={postIndex}>
                                { 
                                tagHeader.map((header)=> (
                                    <td scope="col">{post[header]}</td>
                                ))
                                }
                                <td scope="col"> 
                                    <LinkBox className="btn btn-primary" to={editRoute(post['id'])} >Edit</LinkBox> 
                                    <DangerButton  onClick={() =>deleteRow(deleteRoute(post['id']) ,post['id'])} >Delete</DangerButton>
                                </td>
                            </tr>
                        ))}
                </tbody>
            </table>
        </>
    );
}
