export default function Table({ tagHeader, posts }) {

    // console.log(tagHeader);

    return (
        <>
            <table className="table">
                <thead>
                    <tr>
                       {tagHeader.map((header)=> (
                            <th scope="col">{header}</th>
                        ))}
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        {posts.map((post)=> (
                            tagHeader.map((header)=> (
                                <th scope="col">{post[header]}</th>
                            ))
                        ))}
                    </tr>
                </tbody>
            </table>
        </>
    );
}
