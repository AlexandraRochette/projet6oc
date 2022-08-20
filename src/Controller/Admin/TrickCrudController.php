<?php

namespace App\Controller\Admin;

use App\Entity\Trick;
use App\Form\TrickImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class TrickCrudController extends AbstractCrudController
{
    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    public static function getEntityFqcn(): string
    {
        return Trick::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name')->setLabel('Titre'),
            SlugField::new('slug')->setTargetFieldName('name'),
            TextField::new('subtitle')->setLabel('Sous-titre'),
            ImageField::new('illustration')->setLabel('Image à la Une')->setBasePath('uploads/')->setUploadDir('public/uploads/')->setUploadedFileNamePattern('[randomhash].[extension]')->setRequired(false),
            TextEditorField::new('description'),
            AssociationField::new('category')->setLabel('Catégorie'),
            CollectionField::new('images')->renderExpanded()->allowAdd(true)->setEntryType(TrickImageType::class)->setRequired(false)->onlyOnForms()->setLabel('Images'),
            TextAreaField::new('video')->setLabel('Lien vidéo Youtube'),
            AssociationField::new('author')->setLabel('Auteur'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {

        return $crud;
    }

}
