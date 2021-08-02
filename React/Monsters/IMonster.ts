export interface IMonster
{
  id: number,
  name: string,
  image: string,
  species: {
    id: number,
    name: string
  }
}
