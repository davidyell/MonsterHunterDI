import React, {useEffect, useState} from "react"
import Axios from "axios"

export const Monsters = () => {
    const [monsters, setMonsters] = useState([]);

    useEffect(() => {
        if (monsters.length === 0) {
            fetchMonstersList()
        }
    }, [])

    const fetchMonstersList = async () => {
        const response = await Axios.get(
            'http://localhost:1234/monsters/list',
            { 'headers': { 'Accept': 'application/json' }}
        )

        setMonsters(response.data.monsters)
    }

    return (
        <div id="monster-list">
            <h1>Monsters</h1>
            <div className="container">
                <ul>{ monsters.map(monster => <li key={monster.name}>{monster.name}</li>) }</ul>
            </div>
        </div>
    )
}
