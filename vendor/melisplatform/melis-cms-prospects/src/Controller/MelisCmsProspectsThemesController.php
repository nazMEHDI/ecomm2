<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisCmsProspects\Controller;

use Laminas\Form\Factory;
use Laminas\Session\Container;
use Laminas\View\Model\JsonModel;
use Laminas\View\Model\ViewModel;
use MelisCore\Controller\MelisAbstractActionController;

/**
 * This controller handles the display of the Prospect Theme Tool
 */
class MelisCmsProspectsThemesController extends MelisAbstractActionController
{
    const LOG_ADD = 'CMS_PROSPECTS_THEME_ADD';
    const LOG_UPDATE = 'CMS_PROSPECTS_THEME_UPDATE';
    const LOG_DELETE = 'CMS_PROSPECTS_THEME_DELETE';

    /**
     * Tool container
     * @return ViewModel
     */
    public function toolContainerAction()
    {
        return new ViewModel([
            'melisKey' => $this->getMelisKey()
        ]);
    }

    /**
     * Header view
     * @return ViewModel
     */
    public function toolHeaderAction()
    {
        return new ViewModel([
            'melisKey' => $this->getMelisKey()
        ]);
    }

    /**
     * Header | Add button
     * @return ViewModel
     */
    public function toolHeaderAddAction()
    {
        return new ViewModel();
    }

    /**
     * Content
     * @return ViewModel
     */
    public function toolContentAction()
    {
        $translator = $this->getServiceManager()->get('translator');


        $container = new Container('meliscore');
        $locale    = $container['melis-lang-locale'];
        $columns   = $this->tool()->getColumns();

        // pre-add Action Columns
        $columns['actions'] = array('text' => $translator->translate('tr_meliscore_global_action'), 'width' => '20%');

        $view                         = new ViewModel();
        $view->melisKey               = $this->getMelisKey();
        $view->tableColumns           = $columns;
        $view->getToolDataTableConfig = $this->tool()->getDataTableConfiguration('#tableToolProspectsTheme', true, false, array('order' => '[[ 0, "desc" ]]'));

        return $view;
    }

    /**
     * Modal container
     * @return ViewModel
     */
    public function toolModalContainerAction()
    {
        $id = $this->params()->fromRoute('id', $this->params()->fromQuery('id', ''));

        $melisKey = $this->getMelisKey();

        $view           = new ViewModel();
        $view->setTerminal(false);
        $view->melisKey = $melisKey;
        $view->id       = $id;

        return $view;
    }

    /**
     * Modal content
     * @return ViewModel
     */
    public function toolModalContentAction()
    {
        $id = $this->params()->fromRoute('id', $this->params()->fromQuery('id', ''));

        $melisKey = $this->params()->fromRoute('melisKey', '');
        $title    = $this->tool()->getTranslation('tr_melis_cms_prospects_theme_new_title');
        $data     = array();
        $form     = $this->getThemeForm();

        if(is_numeric($id)) {
            $title = $this->tool()->getTranslation('tr_melis_cms_prospects_theme_edit_title');
            $data  = (array) $this->themeTable()->getEntryById((int) $id)->current();
            $form->setData($data);
        }
        else {
            $elementOptions = $form->get('pros_theme_id')->getOptions();
            unset($elementOptions['tooltip']);
            $form->get('pros_theme_id')->setOptions($elementOptions);
            
            $form->get('pros_theme_id')->setAttribute('style', 'display:none')->setLabel('');
            $form->get('pros_theme_id')->setLabelAttributes(array('style' => 'display:none'));
        }

        $view = new ViewModel();

        $view->melisKey = $melisKey;
        $view->title    = $title;
        $view->form     = $form;

        return $view;
    }

    /**
     * @return ViewModel
     */
    public function limitAction()
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function searchAction()
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function refreshAction()
    {
        return new ViewModel();
    }

    /**
     * Returns the theme items for the data table
     * @return JsonModel
     */
    public function getDataAction()
    {
        $request           = $this->getRequest();
        $dataCount         = 0;
        $dataFilteredCount = 0;
        $tableData         = array();
        $draw              = 0;
        if($request->isPost()) {

            $post           = $request->getPost()->toArray();
            $columns        = array_keys($this->tool()->getColumns());
            $draw           = (int) $post['draw'];
            $selColOrder    = $columns[(int) $post['order'][0]['column']];
            $orderDirection = isset($post['order']['0']['dir']) ? strtoupper($post['order']['0']['dir']) : 'ASC';
            $searchValue    = isset($post['search']['value']) ? $post['search']['value'] : null;
            $searchableCols = $this->tool()->getSearchableColumns();
            $start          = (int) $post['start'];
            $length         = (int) $post['length'];

            $data              = $this->themeTable()->getData($searchValue, $searchableCols, $selColOrder, $orderDirection, $start, $length)->toArray();
            $dataCount         = $this->themeTable()->getTotalData();
            $dataFilteredCount = $this->themeTable()->getTotalFiltered();
            $tableData         = $data;

            for($ctr = 0; $ctr < count($tableData); $ctr++) {
                // apply text limits
                foreach($tableData[$ctr] as $vKey => $vValue) {
                    $tableData[$ctr][$vKey] = $this->tool()->limitedText($vValue, 80);
                }

                $tableData[$ctr]['DT_RowId'] = $tableData[$ctr]['pros_theme_id'];
            }
        }

        $response = [
            'draw'            => $draw,
            'data'            => $tableData,
            'recordsFiltered' => $dataFilteredCount,
            'recordsTotal'    => $dataCount
        ];

        return new JsonModel($response);
    }


    public function searchAllAction()
    {
        return new ViewModel();
    }

    /**
     * Save event for theme tool
     * @return JsonModel
     */
    public function saveAction()
    {
        $success = 0;
        $message = 'tr_melis_cms_prospects_theme_failed';
        $errors = [];
        $title = 'tr_melis_cms_prospects_theme';
        $request = $this->getRequest();
        $id = 0;
        $logType = self::LOG_ADD;

        if ($request->isPost()) {
            $allowSave = false;

            $data = $this->tool()->sanitizeRecursive($request->getPost()->toArray(), ["'", '"'], false);
            if (!empty($data['pros_theme_id'])) {
                $id = (int)$data['pros_theme_id'];
                $logType = self::LOG_UPDATE;
            }

            $melisCoreConfig = $this->getServiceManager()->get('MelisCoreConfig');
            $appConfigForm = $melisCoreConfig->getFormMergedAndOrdered('melistoolprospects/tools/melistoolprospects_tool_prospects_themes/forms/prospects_theme_form', 'prospects_theme_form');
            $factory = new Factory();
            $formElements = $this->getServiceManager()->get('FormElementManager');
            $factory->setFormElementManager($formElements);
            /** @var \Laminas\Form\Form $form */
            $form = $factory->createForm($appConfigForm);
            $form->setData($data);

            if ($form->isValid()) {
                $checkData = $this->themeTable()->getEntryByField('pros_theme_name', $data['pros_theme_name'])->current();
                unset($data['pros_theme_id']);

                if (!$checkData && !$id) {
                    $allowSave = true;
                } elseif ($id && $checkData) {
                    $currentCode = $this->themeTable()->getEntryById($id)->current()->pros_theme_code;
                    if ($currentCode != $data['pros_theme_code']) {
                        // recheck if the code exists
                        $checkData = $this->themeTable()->getEntryByField('pros_theme_code', $data['pros_theme_code'])->current();
                        if (empty($checkData)) {
                            $allowSave = true;
                        } else {
                            $message = 'tr_melis_cms_prospects_theme_code_exists';
                        }
                    } else {
                        $allowSave = true;
                    }
                } else {
                    $allowSave = true;
                }

                if ($allowSave) {
                    $success = $this->themeTable()->save($data, $id);
                    if ($success) {
                        $id = $success;
                        $success = true;
                        $message = 'tr_melis_cms_prospects_theme_success';
                    }
                }
            } else {
                $errors = $form->getMessages();
                foreach ($errors as $keyError => $valueError) {
                    foreach ($appConfigForm as $keyForm => $valueForm) {
                        if (isset($valueForm['spec']['name'])) {
                            if ($valueForm['spec']['name'] == $keyError &&
                                !empty($valueForm['spec']['options']['label'])
                            )
                                $errors[$keyError]['label'] = $valueForm['spec']['options']['label'];
                        }
                    }
                }
            }

        }

        $response = [
            'success' => $success,
            'errors' => $errors,
            'textMessage' => $this->tool()->getTranslation($message),
            'textTitle' => $this->tool()->getTranslation($title)
        ];

        $this->getEventManager()->trigger(
            'meliscmsprospects_theme_save_end',
            $this,
            array_merge(
                $response,
                ['typeCode' => $logType, 'itemId' => $id]
            )
        );

        return new JsonModel($response);
    }

    /**
     * Remove event
     * @return JsonModel
     */
    public function removeAction()
    {
        $success = 0;
        $message = 'tr_melis_cms_prospects_theme_delete_failed';
        $errors = [];
        $title = 'tr_melis_cms_prospects_theme';
        $request = $this->getRequest();
        $id = 0;

        if ($request->isPost()) {
            $id = (int)$request->getPost('id');
            $checkData = $this->themeTable()->getEntryById($id)->current();

            if ($checkData) {
                $this->themeTable()->deleteById($id);
                $this->themeItemTable()->deleteByField('pros_theme_id', $id);
                $success = 1;
                $message = 'tr_melis_cms_prospects_theme_delete_success';
            }
        }

        $response = [
            'success' => $success,
            'errors' => $errors,
            'textMessage' => $this->tool()->getTranslation($message),
            'textTitle' => $this->tool()->getTranslation($title)
        ];

        $this->getEventManager()->trigger(
            'meliscmsprospects_theme_delete_end',
            $this,
            array_merge(
                $response,
                ['typeCode' => self::LOG_DELETE, 'itemId' => $id]
            )
        );

        return new JsonModel($response);
    }

    /**
     * @return ViewModel
     */
    public function itemListAction()
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function editAction()
    {
        return new ViewModel();
    }

    /**
     * @return ViewModel
     */
    public function deleteAction()
    {
        return new ViewModel();
    }

    /**
     * @return mixed
     */
    private function getMelisKey()
    {
        $melisKey = $this->params()->fromRoute('melisKey', null);

        return $melisKey;
    }

    /**
     * @return array|object
     */
    private function tool()
    {
        $tool = $this->getServiceManager()->get('MelisCoreTool');
        $tool->setMelisToolKey('melistoolprospects', 'melistoolprospects_tool_prospects_themes');
        return $tool;
    }

    /**
     * @return array|object
     */
    private function themeTable()
    {
        $table = $this->getServiceManager()->get('MelisCmsProspectsThemeTable');
        return $table;
    }

    /**
     * @return array|object
     */
    private function themeItemTable()
    {
        $table = $this->getServiceManager()->get('MelisCmsProspectsThemeItemTable');
        return $table;
    }


    /**
     * @return mixed
     */
    public function getThemeForm()
    {
        $form = $this->tool()->getForm('prospects_theme_form');
        return $form;
    }


}