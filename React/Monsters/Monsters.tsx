import React, { useEffect, useState } from 'react';
import Axios from 'axios';
import { Link } from 'react-router-dom';

export default () => {
  const [monsters, setMonsters] = useState([]);

  const fetchMonstersList = async () => {
    const response = await Axios.get(
      '/monsters/list',
      { headers: { Accept: 'application/json' } },
    );

    setMonsters(response.data.monsters);
  };

  useEffect(() => {
    if (monsters.length === 0) {
      fetchMonstersList();
    }
  }, []);

  const monsterRows = monsters.map((monster) => (
    <tr key={monster.id}>
      <td>
        <Link to={`/react/monsters/view/${monster.id}`}>{monster.name}</Link>
      </td>
      <td>{monster.species.name}</td>
    </tr>
  ));

  return (
    <div className="container">
      <div className="row">
        <div className="col-md-12">
          <h1>Available Monsters</h1>
        </div>
      </div>

      <table className="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Species</th>
          </tr>
        </thead>
        <tbody>
          {monsterRows}
        </tbody>
      </table>
    </div>
  );
};
