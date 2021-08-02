import React, { useEffect, useState } from 'react';
import { Link } from 'react-router-dom';
import Axios from 'axios';

export default () => {
  const [monster, setMonster] = useState(null);

  const fetchMonster = async () => {
    const response = await Axios.get(
      '/monsters/view/1',
      { headers: { Accept: 'application/json' } },
    );

    setMonster(response.data.monster);
  };

  useEffect(() => {
    if (monster === null) {
      fetchMonster();
    }
  }, []);

  const monsterImage = () => {
    if (monster.image) {
      return (
        <div className="row">
          <div className="col-md-12 text-center">
            <img src={`/img/${monster.image}`} alt={monster.name} />
          </div>
        </div>
      );
    }

    return null;
  };

  return (
    <div className="container">
      <div className="row">
        <div className="col-md-12">
          <h1>{monster.name ? monster.name : ''}</h1>
        </div>
      </div>

      {monsterImage()}

      <div className="row mt-3">
        <div className="col-md-12">
          <table className="table table-striped">
            <tbody>
              <tr>
                <td>Species</td>
                <td><strong>Dave</strong></td>
              </tr>
            </tbody>
          </table>

          <p className="text-center">
            <Link to="/react/index.html" className="btn btn-primary btn-block">👈 Back</Link>
          </p>
        </div>
      </div>
    </div>

  );
};
