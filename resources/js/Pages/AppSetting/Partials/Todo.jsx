export default function Todo({tagList , addTag}) {

    // console.log(tagList)
    return (
        <>
            {tagList.map((todo, index) => (
                    <li key={index}>{todo}</li>
            ))}
            <button onClick={addTag}>Add tag</button>
        </>
    );
}