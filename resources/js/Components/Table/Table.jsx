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
                            <th scope="col">{header.title}</th>
                        ))}
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {posts && posts.map((post ,postIndex)=> (
                        <tr key={postIndex}>
                            { 
                            tagHeader.map((header)=> (
                                header.type == 'image' ? 
                                <td scope="col">
                                    <img height="50" width="50" src={post[header.key]}></img>
                                </td> : 
                                <td scope="col">
                                    {post[header.key]}
                                </td>
                            ))
                            }
                            {/* {console.log(post['id'])} */}
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
