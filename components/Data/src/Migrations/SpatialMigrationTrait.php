<?php declare (strict_types=1);

namespace Limoncello\Data\Migrations;

use Closure;
use Doctrine\DBAL\Schema\Table;
use Limoncello\Flute\Types\GeometryCollectionType;
use Limoncello\Flute\Types\LineStringType;
use Limoncello\Flute\Types\MultiLineStringType;
use Limoncello\Flute\Types\MultiPointType;
use Limoncello\Flute\Types\MultiPolygonType;
use Limoncello\Flute\Types\PointType;
use Limoncello\Flute\Types\PolygonType;

/**
 * @package Limoncello\Data
 */
trait SpatialMigrationTrait
{
    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function point(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, PointType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullablePoint(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, PointType::NAME)->setNotnull(false);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function multiPoint(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, MultiPointType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullableMultiPoint(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, MultiPointType::NAME)->setNotnull(false);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function lineString(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, LineStringType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullableLineString(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, LineStringType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function multiLineString(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, MultiLineStringType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullableMultiLineString(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, MultiLineStringType::NAME)->setNotnull(false);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function polygon(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, PolygonType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullablePolygon(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, PolygonType::NAME)->setNotnull(false);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function multiPolygon(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, MultiPolygonType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullableMultiPolygon(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, MultiPolygonType::NAME)->setNotnull(false);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function geometryCollection(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, GeometryCollectionType::NAME)->setNotnull(true);
        };
    }

    /**
     * @param string $name
     *
     * @return Closure
     */
    protected function nullableGeometryCollection(string $name): Closure
    {
        return function (Table $table) use ($name) {
            $table->addColumn($name, GeometryCollectionType::NAME)->setNotnull(false);
        };
    }
}
