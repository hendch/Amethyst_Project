<?php
class MYSTERYBOX
{
    protected string $name;
    protected float $price;
    protected string $items;
    protected int $sold;
    protected string $image;

    public function __construct(string $name, float $price, string $items, int $sold, string $image)
    {
        $this->name = $name;
        $this->price = $price;
        $this->items = $items;
        $this->sold = $sold;
        $this->image = $image;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getItems(): string
    {
        return $this->items;
    }

    public function setItems(string $items): void
    {
        $this->items = $items;
    }

    public function getSold(): int
    {
        return $this->sold;
    }

    public function setSold(int $sold): void
    {
        $this->sold = $sold;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }
}
?>
